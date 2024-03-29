<?php
namespace App\Http\Controllers\AdminLte\main\accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mountains\Mountains;
use App\Models\mountains\Mountains_photo;
use App\Models\mountains\Mountains_video;
use App\Models\location\City;

use App\Models\accounts\Accounts;

use Illuminate\Support\Facades\DB;
use App\Models\location\Country;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\emails\Emails;

use App\Models\groups\Groups;
use App\Models\articles\Articles;
use App\Models\accounts\Comment;




class AccountsController extends Controller
{
    public function index(Request $request)
    {
        if (session('admin')->role_id == 3) {
            $accountsList = DB::table('user')
                ->select('user.*', 'roles.name as roleName')
                ->join('roles', 'roles.id', '=', 'user.role_id')
                ->where('user.id', '!=', session('admin')->id)
                ->orderby('role_id', 'DESC')
                ->orderby('deactivated', 'ASC')
                ->orderby('user.id', 'ASC')
                ->get();

            $roleList = DB::table('roles')
                ->select('*')

                ->orderBy('id', 'ASC')
                ->get();
        } else if (session('admin')->role_id == 2) {
            $accountsList = DB::table('user')
                ->select('user.*', 'roles.name as roleName')
                ->join('roles', 'roles.id', '=', 'user.role_id')
                ->where('role_id', 1)
                ->orderby('role_id', 'DESC')
                ->orderby('deactivated', 'ASC')
                ->orderby('user.id', 'ASC')
                ->get();
            $roleList = DB::table('roles')
                ->select('*')
                ->where('id', '!=', 3)
                ->where('id', '!=', 2)
                ->orderBy('id', 'ASC')
                ->get();
        }

        $data = [
            'roleList' => $roleList,
            'accountsCheckList' => Accounts::get(),
            'accountsList' => $accountsList,
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];


        return view('AdminLte/main-page/accounts/table')->with($data);
    }

    public function activate(Request $request)
    {
        $button = $request->get('button');
        if ($button != null) {
            if ($button == 'activate') {

                $data = [
                    'deactivated' => 0,
                    'deactivated_date' => null
                ];
                Accounts::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Activate Account Successfully !', 'Account id "' . $request->get('id') . '" has been activate in to database');

            } else if ($button == 'deactivate') {
                $data = [
                    'deactivated' => 1,
                    'deactivated_date' => Carbon::now()->toDateTimeString()
                ];
                Accounts::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Deactivate Account Successfully !', 'Account id "' . $request->get('id') . '" has been deactivate in to database');

            }
        }

        $currentUrl = $request->get('currentUrl');
        if ($currentUrl != null) {

            return redirect($currentUrl);
        }

        return redirect('/admin/accounts/table');
    }
    public function addForm()
    {
        if (session('admin')->role_id == 3) {
            $roleList = DB::table('roles')
                ->select('*')
                ->orderBy('id', 'ASC')
                ->get();
        } else if (session('admin')->role_id == 2) {

            $roleList = DB::table('roles')
                ->select('*')
                ->where('id', '!=', 3)
                ->where('id', '!=', 2)
                ->orderBy('id', 'ASC')
                ->get();
        }

        $data = [
            'roleList' => $roleList,
            'accountsList' => Accounts::get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        return view('AdminLte/main-page/accounts/add')->with($data);



    }


    public function proccessAdd(Request $request)
    {

        $button = $request->get('button');
        if ($button != null && $button == 'add') {
            $fullname = $request->input('fullname');
            $gender = $request->get('gender');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $dob = Carbon::createFromFormat('d/m/Y', $request->get('dob'))->format('Y-m-d');
            ;
            $roleid = $request->get('roleid');
            $username = $request->get('username');
            $password = $request->get('password');
            $deactivated = $request->has('status') ? 0 : 1;




            DB::beginTransaction();
            $main_photo = $request->file('main-photo');
            if ($main_photo == null) {
                $mainPhotoName = null;
            } else if (session()->has('main-photo') && File::exists(public_path('img/accounts/temporary/' . session()->get('main-photo')))) {
                //$mainPhotoName = now()->timestamp . "_" . $main_photo->getClientOriginalName();

                $mainPhotoName = session()->get('main-photo');


            } else {
                $mainPhotoName = null;
            }
            try {
                // Thêm dữ liệu vào bảng Mountain
                $account = new Accounts();
                $account->photo = $mainPhotoName;
                $account->username = $username;
                $account->fullname = $fullname;
                $account->gender = $gender;
                $account->password = Hash::make($password);
                $account->email = $email;
                $account->dob = $dob;
                $account->phone = $phone;
                $account->role_id = $roleid;
                $account->deactivated = $deactivated;
                $account->created = Carbon::now()->format('Y-m-d');

                // Thêm các trường khác tương ứng
                $account->save();

                $accountId = (int) $account->id;


                $accountPath = public_path('img/accounts/' . $accountId);

                if (!File::isDirectory($accountPath)) {
                    File::makeDirectory($accountPath, 0755, true, true);
                }
                if ($request->hasFile('main-photo') && session()->has('main-photo') && File::exists(public_path('img/accounts/temporary/' . session()->get('main-photo')))) {
                    // $main_photo = $request->file('main-photo');

                    // $main_photo->move(public_path('img/accounts/' . $accountId), $mainPhotoName);

                    session()->forget('main-photo');
                    $sourceFilePath = public_path('img/accounts/temporary/' . $mainPhotoName);

                    // Đường dẫn đích (thư mục đích + tên file mới)
                    $destinationFilePath = public_path('img/accounts/' . $accountId . '/' . $mainPhotoName);

                    // Copy file từ nguồn đến đích
                    File::copy($sourceFilePath, $destinationFilePath);

                    File::delete($sourceFilePath);
                }


                DB::commit();

                // session()->put('icon', 'success');
                // session()->put('mess', 'Add Account Successfully !');
                // session()->put('text', 'Account id "'.$accountId.'" has been add in to database');
                $this->messMaker('success', 'Add Account Successfully !', 'Account id "' . $accountId . '" has been add in to database');


                return redirect('/admin/accounts/table');
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect('/admin/accounts/table');
    }
    public function proccessUpdate(Request $request)
    {

        $button = $request->get('button');
        if ($button != null && $button == 'update') {
            $id = $request->input('id');
            $fullname = $request->input('fullname');
            $gender = $request->get('gender');
            $email = $request->get('email');
            $phone = $request->get('phone');

            $dob = Carbon::createFromFormat('d/m/Y', $request->get('dob'))->format('Y-m-d');
            ;
            $roleid = $request->get('roleid');
            $username = $request->get('username');

            $password = $request->get('password');

            DB::beginTransaction();
            $main_photo = $request->file('main-photo');
            if ($main_photo == null) {
                $mainPhotoName = null;
            } else if (session()->has('main-photo') && File::exists(public_path('img/accounts/temporary/' . session()->get('main-photo')))) {
                //$mainPhotoName = now()->timestamp . "_" . $main_photo->getClientOriginalName();
                $mainPhotoName = session()->get('main-photo');

            } else {
                $mainPhotoName = null;
            }
            try {
                // Thêm dữ liệu vào bảng Mountain
                $account = Accounts::find($id);
                if ($main_photo != null) {
                    $account->photo = $mainPhotoName;
                }
                //$account->photo = $mainPhotoName;
                //$account->username = $username;
                $account->fullname = $fullname;
                $account->gender = $gender;
                if ($password != null && $password != '') {
                    $account->password = Hash::make($password);
                }
                $account->email = $email;
                $account->dob = $dob;
                $account->phone = $phone;
                $account->role_id = $roleid;
                //$account->created = Carbon::now()->format('Y-m-d');

                // Thêm các trường khác tương ứng
                $account->save();

                $accountId = (int) $account->id;


                $accountPath = public_path('img/accounts/' . $accountId);

                if (!File::isDirectory($accountPath)) {
                    File::makeDirectory($accountPath, 0755, true, true);
                }
                // if ($request->hasFile('main-photo')) {
                //     $main_photo = $request->file('main-photo');

                //     $main_photo->move(public_path('img/accounts/' . $accountId), $mainPhotoName);

                // }
                if ($request->hasFile('main-photo') && session()->has('main-photo') && File::exists(public_path('img/accounts/temporary/' . session()->get('main-photo')))) {
                    // $main_photo = $request->file('main-photo');

                    // $main_photo->move(public_path('img/accounts/' . $accountId), $mainPhotoName);

                    session()->forget('main-photo');
                    $sourceFilePath = public_path('img/accounts/temporary/' . $mainPhotoName);

                    // Đường dẫn đích (thư mục đích + tên file mới)
                    $destinationFilePath = public_path('img/accounts/' . $accountId . '/' . $mainPhotoName);

                    // Copy file từ nguồn đến đích
                    File::copy($sourceFilePath, $destinationFilePath);

                    File::delete($sourceFilePath);
                }



                DB::commit();
                $this->messMaker('success', 'Update Account Successfully !', 'Account id "' . $accountId . '" has been update in to database');
                $url = $request->get('currentUrl');
                if ($url != null) {
                    return redirect($url);
                }

                return redirect('/admin/accounts/table');
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect('/admin/accounts/table');
    }

    public function profile(Request $request)
    {
        $id = $request->get('id');
        $mountainLikeList = DB::table('likes_mountains')
            ->select('likes_mountains.*', 'mountains.*')
            ->join('mountains', 'id', '=', 'mountain_id')
            ->where('deactivated', 0)
            ->where('user_id', $id)
            ->get();

        // Like_Mountains::where('user_id', session()->get('user')->id)->join('')->get();

        $groupLikeList = DB::table('likes_groups')
            ->select('likes_groups.*', 'grouporgclub.*')
            ->join('grouporgclub', 'id', '=', 'group_id')
            ->where('deactivated', 0)
            ->where('user_id', $id)
            ->get();



        //Like_Groups::where('user_id', session()->get('user')->id)->get();

        $articleLikeList = DB::table('likes_articles')
            ->select('likes_articles.*', 'article.id', 'article.name', 'article.photo')
            ->join('article', 'id', '=', 'article_id')
            ->where('deactivated', 0)
            ->where('user_id', $id)
            ->get();

        $mountainCommentList = DB::table('comments')
            ->select('comments.*', 'user.fullname', 'user.photo')
            ->join('user', 'user.id', '=', 'comments.user_id')
            ->where('user.id',$id)
            ->whereNotNull('mountain_id')
            ->orderBy('created', 'DESC')
            ->get();
        $groupCommentList = DB::table('comments')
            ->select('comments.*', 'user.fullname', 'user.photo')
            ->join('user', 'user.id', '=', 'comments.user_id')
            ->where('user.id',$id)
            ->whereNotNull('group_id')
            ->orderBy('created', 'DESC')
            ->get();
        $articleCommentList = DB::table('comments')
            ->select('comments.*', 'user.fullname', 'user.photo')
            ->join('user', 'user.id', '=', 'comments.user_id')
            ->where('user.id',$id)
            ->whereNotNull('article_id')
            ->orderBy('created', 'DESC')
            ->get();
        $mountainList= Mountains::where('deactivated',0)->get();
        $groupList= Groups::where('deactivated',0)->get();
        $articleList= Articles::where('deactivated',0)->get();

        $data = [
            'account' => DB::table('user')
                ->select('user.*', 'roles.name as roleName')
                ->join('roles', 'roles.id', '=', 'user.role_id')
                ->where('user.id', $id)
                ->first(),
            'mountainLikeList' => $mountainLikeList,
            'groupLikeList' => $groupLikeList,
            'articleLikeList' => $articleLikeList,
            'accountsCheckList' => Accounts::get(),
            'mountainCommentList' =>$mountainCommentList,
            'groupCommentList' => $groupCommentList,
            'articleCommentList' => $articleCommentList,
            'mountainList' => $mountainList,
            'groupList' =>$groupList,
            'articleList' =>$articleList,
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()

        ];
        return view('AdminLte/main-page/accounts/profile')->with($data);
    }

    public function proccessUpdateAdminPassword(Request $request)
    {
        $button = $request->get('button');
        if ($button != null && $button == 'update') {
            $id = $request->input('id');
            $oldPassword = $request->input('oldPassword');
            $password = $request->get('password');

            DB::beginTransaction();

            try {
                $url = $request->get('currentUrl');
                $account = Accounts::find($id);
                if (Hash::check($oldPassword, $account->password) == true) {
                    $this->messMaker('success', 'New Password Has Been Set !', 'You Are Required To Log In Again !');

                    if ($password != null && $password != '') {
                        $account->password = Hash::make($password);
                        $account->save();
                        session()->forget('admin');
                        $url = '/admin';
                    }
                } else {
                    $this->messMaker('error', 'Old Password Is Wrong !', 'Please try again !');

                }

                DB::commit();

                return redirect($url);
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect('/admin/accounts/table');

    }

    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }

    public function test(Request $request)
    {
        $data = [
            'roleList' => DB::table('roles')
                ->select('*')
                ->orderBy('id', 'ASC')
                ->get(),
            'accountsList' => Accounts::get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        //return view('AdminLte/main-page/accounts/add')->with($data);


        $this->messMaker('success', 'Add Account Successfully !', 'Account id  database');
        //session()->forget('ngu');
        return view('AdminLte/main-page/accounts/test')->with($data);
    }

    public function store(Request $request)
    {
        $folderPath = public_path('img/accounts/temporary/'); //create folder upload public/upload

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = now()->timestamp . "_main.jpg";

        $imageFullPath = $folderPath . $imageName;

        session()->put('main-photo', $imageName);
        file_put_contents($imageFullPath, $image_base64);

        //  $saveFile = new Image;
        //  $saveFile->title = $imageName;
        //  $saveFile->save();

        return response()->json(['success' => 'Crop Image Saved/Uploaded Successfully']);
    }

    public function removeComment(Request $request){
        $comment_id=$request->get('comment_id');
        Comment::where('id',$comment_id)->delete();
    }



}


