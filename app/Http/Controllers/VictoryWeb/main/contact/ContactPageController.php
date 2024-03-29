<?php

namespace App\Http\Controllers\VictoryWeb\main\contact;

use App\Http\Controllers\Controller;
use App\Models\articles\Articles;
use App\Models\articles\Categories;
use App\Models\emails\Emails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactPageController extends Controller
{
    public function index()
    {
        $data=[
            'recapchaKey' => config('services.recaptcha.key')
        ];
        return view('VictoryWeb/main-page/contact-page/contact')->with($data);
    }


    public function send(Request $request)
{
    // Xác minh reCAPTCHA
    $responseKey = $request->input('g-recaptcha-response');
    $secretKey = env('RECAPTCHA_SECRET_KEY'); // Đảm bảo bạn đã thêm khóa này vào file .env
    $userIP = $request->ip();
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$responseKey.'&remoteip='.$userIP);
    $responseData = json_decode($verifyResponse);
    if (!$responseData->success) {
        // Nếu xác minh thất bại, quay trở lại với thông báo lỗi
        return back()->with('error', 'reCAPTCHA verification failed. Please try again.');
    }

    // Xử lý thông tin form và gửi email ở đây
    $details = [
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
    ];

    Mail::send('VictoryWeb.main-page.contact-page.emails', ['details' => $details], function ($message) use ($details) {
        $message->to('2024victory2024@gmail.com')->subject('New Contact Message');
    });

    // Lưu thông tin vào cơ sở dữ liệu
    Emails::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
        'created' => Carbon::now(),
        'status'=>0
    ]);

    // Quay trở lại với thông báo thành công
    return back()->with('success', 'Thank you for your message!');
}



}
