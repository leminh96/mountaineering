<?php
namespace App\Http\Controllers\AdminLte\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\accounts\Accounts;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    public function index(Request $request)
    {
        

        // $icon= session()->get('icon');
        // $mess= session()->get('mess');
        // $text= session()->get('text');
        // if($icon != null){
        //     session()->forget('icon');
        // }
        // if($mess != null){
        //     session()->forget('mess');
        // }
        // if($text != null){
        //     session()->forget('text');
        // }
        // $data=[
        //     'icon' => $icon,
        //     'mess'=> $mess,
        //     'text' =>$text
        // ];

        // return view('AdminLte/login/loginForm')->with($data);

        return view('AdminLte/login/loginForm');
    }
    public function logout(Request $request)
    {
        $logout = $request->get('command');
        if ($logout != null && $logout == 'logout') {
            session()->forget('admin');
        }


        return redirect("/admin");
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

        //  $saveFile = new Image;
        //  $saveFile->title = $imageName;
        //  $saveFile->save();

        return response()->json(['success' => 'Crop Image Saved/Uploaded Successfully']);
    }
    public function proccessLogin(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        
        $admin = Accounts::whereRaw("BINARY  username = ?", [$username])
            ->where(function ($query) {
                $query->where('role_id', 2)
                    ->orWhere('role_id', 3);
            })
            ->first();

        if ($admin != null && Hash::check($password, $admin->password)) {
            if($admin->deactivated==1){
                $this->messMaker('error', 'Sign In Failed !', 'This account has been deactivated');
                session()->forget('admin');
            }else{
                session()->put('admin', $admin);
                $data = [
                    'mess' => 'Welcome To Admin Page !',
                    'text' => ($admin->gender == 'male' ? 'Mr ' : 'Ms ') . $admin->fullname
                ];
                
                $this->messMaker('success', 'Welcome To Admin Page !', ($admin->gender == 'male' ? 'Mr ' : 'Ms ') . $admin->fullname);
                //session()->put('newLoginAction',true);
                
            }
            
            return redirect('/admin/dashboard');
        } else {
            session()->forget('admin');
            $data = [
                'mess' => 'Sign In Failed !',
                'text' => 'Please try again'
            ];
            
            $this->messMaker('error', 'Sign In Failed !', 'Wrong username or password');

            return redirect('/admin');
        }


    }
    public function proccessRegister(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $user = Accounts::whereRaw("username = ?", [$username])->whereRaw("password = ?", [$password])->first();
        $data = [
            'user' => $user,
            'photo' => '<img src="{{asset("assets/img/profile-img.jpg")}}" alt="">'
        ];
        if ($user != null) {
            session()->put('user', $user);
        } else {
            session()->forget('user');
            return view('loginInfo')->with($data);
        }

        return redirect('/customer');
    }
    public function register()
    {

        return view('AdminLte/login/registerForm');
    }

    public function dashboard()
    {

        return view('AdminLte/main-page/dashboard/dashboard');
    }

    public function getNewestAdminLoginId(){
        $id= session()->get('admin')->id;
        if($id !=null){
            return response()->json(array('adminId' =>$id), 200);
        }else{
            return response()->json(array('adminId' =>null), 200);
        }
        
    }
    
    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }




}


