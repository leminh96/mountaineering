<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Kiểm tra xem có phải là ngoại lệ do throttle gây ra không
        if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
            // Trả về phản hồi với mã 429 (Too Many Requests) và thông báo tùy chỉnh
            return redirect()->back()->with(['error'=>'You have request too many times, please try again later']);
        }

        return parent::render($request, $exception);
    }
}
