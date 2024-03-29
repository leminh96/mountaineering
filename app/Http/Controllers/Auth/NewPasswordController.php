<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account; // Sử dụng model Account của bạn
use App\Models\accounts\Accounts;
use App\Models\emails\Emails;

use App\Models\resetpassword\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): JsonResponse
    // {
    //     $request->validate([
    //         'token' => ['required'],
    //         'email' => ['required', 'email'],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     // Here we will attempt to reset the user's password. If it is successful we
    //     // will update the password on an actual user model and persist it to the
    //     // database. Otherwise we will parse the error and return the response.
    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user) use ($request) {
    //             $user->forceFill([
    //                 'password' => Hash::make($request->password),
    //                 'remember_token' => Str::random(60),
    //             ])->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     if ($status != Password::PASSWORD_RESET) {
    //         throw ValidationException::withMessages([
    //             'email' => [__($status)],
    //         ]);
    //     }

    //     return response()->json(['status' => __($status)]);
    // }



    public function processUpdate(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            // Thêm các rule validation cho các trường khác tùy ý
        ]);

        DB::beginTransaction();
        try {
            // Tìm người dùng bằng email
            $account = Accounts::where('email', $request->email)->firstOrFail();
            
            // Cập nhật thông tin người dùng
            $account->password = Hash::make($request->password); // Cập nhật mật khẩu
            // Thêm logic cập nhật các trường thông tin khác của người dùng ở đây
            
            $account->save();

            // Thêm logic xử lý file ảnh nếu cần
            
            DB::commit();

            // Redirect hoặc trả về response thành công
            if ($account->role_id == 1) {
                PasswordResetToken::where("email", $account->email)->delete();
                if(session()->has('user') && session()->get('user')->id == $account->id){
                    session()->forget('user');
                }
                // Redirect người dùng thông thường
                return redirect('/login')->with('mess', 'Account updated successfully!');
            } else {
                PasswordResetToken::where("email", $account->email)->delete();
                if(session()->has('admin') && session()->get('admin')->id == $account->id){
                    session()->forget('admin');
                }
                // Redirect người quản trị
                return redirect('/admin')->with('mess', 'Account updated successfully!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            // Logging error or return error message
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
