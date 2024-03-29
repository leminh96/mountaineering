<?php

namespace App\Http\Controllers\VictoryWeb\main\account;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\accounts\Accounts;
use App\Models\accounts\Like_Mountains;
use App\Models\accounts\Like_Articles;
use App\Models\accounts\Like_Groups;
use App\Models\accounts\Rate_Mountains;
use App\Models\accounts\Rate_Groups;
use App\Models\accounts\Comment;

use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountPageController extends Controller
{
    //mon custom
    public function index(Request $request)
    {

        



        $mountainLikeList = DB::table('likes_mountains')
            ->select('likes_mountains.*', 'mountains.*')
            ->join('mountains', 'id', '=', 'mountain_id')
            ->where('deactivated', 0)
            ->where('user_id', session()->get('user')->id)
            ->get();

        // Like_Mountains::where('user_id', session()->get('user')->id)->join('')->get();

        $groupLikeList = DB::table('likes_groups')
            ->select('likes_groups.*', 'grouporgclub.*')
            ->join('grouporgclub', 'id', '=', 'group_id')
            ->where('deactivated', 0)
            ->where('user_id', session()->get('user')->id)
            ->get();



        //Like_Groups::where('user_id', session()->get('user')->id)->get();

        $articleLikeList = DB::table('likes_articles')
            ->select('likes_articles.*', 'article.id', 'article.name', 'article.photo')
            ->join('article', 'id', '=', 'article_id')
            ->where('deactivated', 0)
            ->where('user_id', session()->get('user')->id)
            ->get();



        //Like_Articles::where('user_id', session()->get('user')->id)->get();

        $data = [
            'accountsCheckList' => Accounts::get(),
            'mountainLikeList' => $mountainLikeList,
            'groupLikeList' => $groupLikeList,
            'articleLikeList' => $articleLikeList

        ];
        return view('VictoryWeb/main-page/account-page/profile')->with($data);
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

            $dob = $request->get('dob');

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
                $this->messMaker('success', 'Update Account Successfully !', 'Your Infomation Has Been Updated !"');

                return redirect('/account/profile');
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
    public function addMountain(Request $request)
    {
        $userID = session()->get('user')->id;
        $mountainID = $request->get('mountainID');
        $created = Carbon::now()->format('Y-m-d');
        $action = $request->get('action');
        $like = [
            "user_id" => $userID,
            'mountain_id' => $mountainID,
            'created' => $created
        ];
        if ($action == 'add') {
            Like_Mountains::create($like);

        } else if ($action == 'remove') {
            Like_Mountains::where('user_id', $userID)->where('mountain_id', $mountainID)->delete();
        }
    }
    public function addArticle(Request $request)
    {
        $userID = session()->get('user')->id;
        $articleID = $request->get('articleID');
        $created = Carbon::now()->format('Y-m-d');
        $action = $request->get('action');
        $like = [
            "user_id" => $userID,
            'article_id' => $articleID,
            'created' => $created
        ];
        if ($action == 'add') {
            Like_Articles::create($like);

        } else if ($action == 'remove') {
            Like_Articles::where('user_id', $userID)->where('article_id', $articleID)->delete();
        }
    }
    public function addGroup(Request $request)
    {
        $userID = session()->get('user')->id;
        $groupID = $request->get('groupID');
        $created = Carbon::now()->format('Y-m-d');
        $action = $request->get('action');
        $like = [
            "user_id" => $userID,
            'group_id' => $groupID,
            'created' => $created
        ];
        if ($action == 'add') {
            Like_Groups::create($like);

        } else if ($action == 'remove') {
            Like_Groups::where('user_id', $userID)->where('group_id', $groupID)->delete();
        }
    }
    public function rateMountain(Request $request)
    {
        $userID = session()->get('user')->id;
        $mountainID = $request->get('mountainID');
        $score = $request->get('score');
        $created = Carbon::now()->format('Y-m-d');
        $rate = [
            "user_id" => $userID,
            'mountain_id' => $mountainID,
            'rate_score' => $score,
            'created' => $created
        ];


        $mountain = Rate_Mountains::where('user_id', $userID)->where('mountain_id', $mountainID)->first();

        if ($mountain) {
            // Nếu đã tồn tại, cập nhật dữ liệu
            $mountain->where('user_id', $userID)->where('mountain_id', $mountainID)->update($rate);
        } else {
            // Nếu chưa tồn tại, thêm mới dữ liệu
            Rate_Mountains::create($rate);
        }
    }

    public function rateGroup(Request $request)
    {
        $userID = session()->get('user')->id;
        $groupID = $request->get('groupID');
        $score = $request->get('score');
        $created = Carbon::now()->format('Y-m-d');
        $rate = [
            "user_id" => $userID,
            'group_id' => $groupID,
            'rate_score' => $score,
            'created' => $created
        ];


        $group = Rate_Groups::where('user_id', $userID)->where('group_id', $groupID)->first();

        if ($group) {
            // Nếu đã tồn tại, cập nhật dữ liệu
            $group->where('user_id', $userID)->where('group_id', $groupID)->update($rate);
        } else {
            // Nếu chưa tồn tại, thêm mới dữ liệu
            Rate_Groups::create($rate);
        }
    }

    public function comment(Request $request)
    {
        $type = $request->get('type');
        $id = $request->get('id');
        $comment_text = $request->get('comment_text');
        //date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        $created = Carbon::now()->toDateTimeString();

        $mountainID = null;
        $groupID = null;
        $articleID = null;
        if ($type == 'mountain') {
            $mountainID = $id;
        } else if ($type == 'group') {
            $groupID = $id;
        } else if ($type == 'article') {
            $articleID = $id;
        }
        $comment = [
            'user_id' => session()->get('user')->id,
            'created' => $created,
            'comment_text' => $comment_text,
            'mountain_id' => $mountainID,
            'group_id' => $groupID,
            'article_id' => $articleID

        ];
        Comment::create($comment);
    }


    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }

}
