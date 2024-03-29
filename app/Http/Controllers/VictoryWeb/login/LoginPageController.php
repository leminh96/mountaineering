<?php

namespace App\Http\Controllers\VictoryWeb\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\accounts\Accounts;


use Illuminate\Support\Facades\DB;
use App\Models\location\Country;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


class LoginPageController extends Controller
{
    public function loginForm()
    {

        return view('VictoryWeb/login/loginForm');
    }


    public function logout(Request $request)
    {
        $logout = $request->get('command');
        if ($logout != null && $logout == 'logout') {


            // Lấy URL trước đó
            $previousUrl = url()->previous();
            session()->forget('user');
            // Kiểm tra xem URL trước đó có phải là trang profile không
            if (strpos($previousUrl, '/account/profile') !== false) {
                

                return redirect('/login'); // Chuyển hướng người dùng đến trang đăng nhập
            }
        }

        return redirect()->back(); // Nếu không, quay lại trang trước đó
    }

    public function removeMessSession()
    {

        session()->forget('icon');


        session()->forget('mess');


        session()->forget('text');
    }
    public function store(Request $request)
    {
        $folderPath = public_path('img/accounts/'); //create folder upload public/upload

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.jpg';

        $imageFullPath = $folderPath . $imageName;

        session()->put('path', $imageFullPath);
        file_put_contents($imageFullPath, $image_base64);



        return response()->json(['success' => 'Crop Image Saved/Uploaded Successfully']);
    }
    public function proccessLogin(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        if( $username !=null && $password != null){
            $user = Accounts::whereRaw("BINARY  username = ?", [$username])
            ->where(function ($query) {
                $query->where('role_id', 1);
            })
            ->first();

        if ($user != null && Hash::check($password, $user->password)) {
            if ($user->deactivated == 1) {
                $this->messMaker('error', 'Sign In Failed !', 'This account has been deactivated');
                session()->forget('user');
            } else {
                session()->put('user', $user);
                $data = [
                    'mess' => 'Welcome To Victory Mountaineering !',
                    'text' => ($user->gender == 'male' ? 'Mr ' : 'Ms ') . $user->fullname
                ];

                $this->messMaker('success', 'Welcome To Victory Mountaineering !', ($user->gender == 'male' ? 'Mr. ' : 'Ms. ') . $user->fullname);


            }

            return redirect('/');
        } else {
            session()->forget('user');
            $data = [
                'mess' => 'Sign In Failed !',
                'text' => 'Please try again'
            ];

            $this->messMaker('error', 'Sign In Failed !', 'Wrong username or password');

            return redirect('/login');
        }
        }else{
            return redirect('/');
        }

    }




    public function registerForm()
    {
        $data = [
            'accountsList' => Accounts::get()
        ];
        return view('VictoryWeb/login/register')->with($data);
    }

    public function proccessRegister(Request $request)
    {

        $button = $request->get('button');
        if ($button != null && $button == 'add') {
            $fullname = $request->input('fullname');
            $gender = $request->get('gender');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $dob = $request->get('dob');
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
                // Thêm dữ liệu vào bảng account
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


                $this->messMaker('success', 'Register Successfully !', 'welcome to our team!');


                return redirect('/login');
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }
        }
        return redirect('/');
    }
    public function getNewestUserLoginId()
    {
        $id = session()->get('user')->id;
        if ($id != null) {
            return response()->json(array('userId' => $id), 200);
        } else {
            return response()->json(array('userId' => null), 200);
        }
    }
    public function forgotpassword() {
        
        return view('forgotpassword');
    }
    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }
}
