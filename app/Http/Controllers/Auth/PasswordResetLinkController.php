<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Models\accounts\Accounts; // Đảm bảo sử dụng đúng namespace của model Accounts

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)//: JsonResponse
    {
        // Thay đổi phần validate để nhận 'username' thay vì 'email'
        $request->validate([
            'username' => ['required', 'string'],
        ]);

        // Tìm email dựa vào username
        $user = Accounts::where('username', $request->username)->first();

        // Kiểm tra nếu không tìm thấy user
        if (!$user) {
            throw ValidationException::withMessages([
                'username' => [trans('passwords.user')],
            ]);
        }

        // Gửi link đặt lại mật khẩu tới email của user
        $status = Password::sendResetLink(['email' => $user->email]);

        // Kiểm tra trạng thái và trả về response tương ứng
        if ($status == Password::RESET_LINK_SENT) {
            // Trả về view với session message thành công
            return redirect()->back()->with('status', trans($status));
        } else {
            // Trả về view với thông báo lỗi
            return redirect()->back()->withErrors(['username' => trans($status)]);
        }
    }
}
