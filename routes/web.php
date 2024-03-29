<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLte\login\LoginController;
use App\Http\Controllers\AdminLte\main\dashboard\DashboardController;
use App\Http\Controllers\AdminLte\main\mountains\MountainsController;
use App\Http\Controllers\AdminLte\main\accounts\AccountsController;
use App\Http\Controllers\AdminLte\main\articles\ArticlesController;
use App\Http\Controllers\AdminLte\main\groups\GroupsController;
use App\Http\Controllers\AdminLte\main\contact\EmailsController;


use App\Http\Controllers\VictoryWeb\main\home\HomePageController;
use App\Http\Controllers\VictoryWeb\main\mountain\MountainPageController;
use App\Http\Controllers\VictoryWeb\main\article\ArticlePageController;
use App\Http\Controllers\VictoryWeb\main\group\GroupPageController;
use App\Http\Controllers\VictoryWeb\main\aboutus\AboutusPageController;
use App\Http\Controllers\VictoryWeb\login\LoginPageController;
use App\Http\Controllers\VictoryWeb\main\account\AccountPageController;
use App\Http\Controllers\VictoryWeb\main\contact\ContactPageController;
use App\Http\Controllers\nhap\AboutUsControllerNhap;
use App\Http\Controllers\nhap\ArticleControllerNhap;
use App\Http\Controllers\nhap\DestinationControllerNhap;
use App\Http\Controllers\nhap\GroupControllerNhap;
use App\Http\Controllers\nhap\HomeControllerNhap;
use App\Http\Controllers\nhap\MountainControllerNhap;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Models\resetpassword\PasswordResetToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [LoginController::class, 'index'])->middleware('RedirectLogin::class');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/getNewestAdminLoginId', [LoginController::class, 'getNewestAdminLoginId']);

    Route::post('/proccessLogin', [LoginController::class, 'proccessLogin']);
    Route::post('/proccessRegister', [LoginController::class, 'proccessRegister']);

    Route::get('/register', [LoginController::class, 'register']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('checkAdminlogin::class');
    Route::get('/removeMessSession', [LoginController::class, 'removeMessSession']);
    Route::post('/test', [LoginController::class, 'test']);
    Route::post('/store', [LoginController::class, 'store'])->name('store');

    Route::group(['prefix' => 'mountains', 'middleware' => 'checkAdminlogin'], function () {
        Route::get('/table', [MountainsController::class, 'index']);
        Route::post('/activate', [MountainsController::class, 'activate']);
        Route::get('/add', [MountainsController::class, 'addForm']);
        Route::post('/proccessAdd', [MountainsController::class, 'proccessAdd']);
        Route::post('/proccessUpdate', [MountainsController::class, 'proccessUpdate']);
        Route::get('/detail', [MountainsController::class, 'detail']);
        Route::get('/getCurrentInfo', [MountainsController::class, 'getCurrentInfo']);
        Route::post('/addCountry', [MountainsController::class, 'addCountry']);
        Route::post('/addCity', [MountainsController::class, 'addCity']);
        // Route::post('/addCountry', [MountainsController::class, 'addCountry']);
        // Route::post('/addCity', [MountainsController::class, 'addCity']);
    });

    Route::group(['middleware' => 'checkAdminlogin'], function () {
        Route::post('/addCountry', [MountainsController::class, 'addCountry']);
        Route::post('/addCity', [MountainsController::class, 'addCity']);
    });

    

    Route::group(['prefix' => 'accounts', 'middleware' => 'checkAdminlogin'], function () {
        Route::get('/table', [AccountsController::class, 'index']);
        Route::get('/add', [AccountsController::class, 'addForm']);
        Route::post('/proccessAdd', [AccountsController::class, 'proccessAdd']);
        Route::post('/activate', [AccountsController::class, 'activate']);
        Route::post('/proccessUpdate', [AccountsController::class, 'proccessUpdate']);
        Route::post('/proccessUpdateAdminPassword', [AccountsController::class, 'proccessUpdateAdminPassword']);
        Route::get('/profile', [AccountsController::class, 'profile']);
        Route::get('/removeComment', [AccountsController::class, 'removeComment'])->name('removeComment');
        Route::get('/test', [AccountsController::class, 'test']);

    });

    Route::group(['prefix' => 'articles', 'middleware' => 'checkAdminlogin'], function () {
        Route::get('/table', [ArticlesController::class, 'index']);
        Route::post('/activate', [ArticlesController::class, 'activate']);
        Route::post('/proccessAdd', [ArticlesController::class, 'proccessAdd']);
        Route::get('/add', [ArticlesController::class, 'addForm']);
        Route::post('/proccessUpdate', [ArticlesController::class, 'proccessUpdate']);
        Route::get('/detail', [ArticlesController::class, 'detail']);
        Route::get('/getCurrentInfo', [ArticlesController::class, 'getCurrentInfo']);

    });

    Route::group(['prefix' => 'groups', 'middleware' => 'checkAdminlogin'], function () {

        Route::get('/table', [GroupsController::class, 'index']);
        Route::post('/activate', [GroupsController::class, 'activate']);
        Route::post('/proccessAdd', [GroupsController::class, 'proccessAdd']);
        Route::get('/add', [GroupsController::class, 'addForm']);
        Route::post('/proccessUpdate', [GroupsController::class, 'proccessUpdate']);
        Route::get('/detail', [GroupsController::class, 'detail']);

    });
    Route::group(['prefix' => 'rating', 'middleware' => 'checkAdminlogin'], function () {
        Route::get('/rateMountains', [MountainsController::class, 'rateMountains']);
        Route::get('/rateGroups', [GroupsController::class, 'rateGroups']);
    });
    Route::group(['prefix' => 'contact', 'middleware' => 'checkAdminlogin'], function () {
        Route::get('/emails', [EmailsController::class, 'index']);
        Route::post('/read', [EmailsController::class, 'Read']);
    });


});



Route::group([], function () {
    Route::get('/', [HomePageController::class, 'index'])->middleware('checkUserLogin::class');
    Route::get('/home', [HomePageController::class, 'index'])->middleware('checkUserLogin::class');
    Route::get('/login', [LoginPageController::class, 'loginForm'])->middleware('RedirectLoginUser::class');
    Route::get('/logout', [LoginPageController::class, 'logout']);
    Route::get('/register', [LoginPageController::class, 'registerForm'])->middleware('RedirectLoginUser::class');
    Route::post('/proccessLogin', [LoginPageController::class, 'proccessLogin']);
    Route::post('/proccessRegister', [LoginPageController::class, 'proccessRegister']);
    Route::post('/store', [AccountsController::class, 'store'])->name('storeAccountImage');

    Route::group(['prefix' => 'account', 'middleware' => 'RedirectProfileUser'], function () {

        Route::get('/profile', [AccountPageController::class, 'index']);

        Route::post('/proccessUpdate', [AccountPageController::class, 'proccessUpdate']);
        //like
        Route::get('/MountainFavoriteList', [AccountPageController::class, 'addMountain'])->name('addMountain');

        Route::get('/ArticleFavoriteList', [AccountPageController::class, 'addArticle'])->name('addArticle');

        Route::get('/GroupFavoriteList', [AccountPageController::class, 'addGroup'])->name('addGroup');
        //rate
        Route::get('/MountainRateList', [AccountPageController::class, 'rateMountain'])->name('rateMountain');

        Route::get('/GroupRateList', [AccountPageController::class, 'rateGroup'])->name('rateGroup');
        //comment
        Route::get('/comment', [AccountPageController::class, 'comment'])->name('comment');
    });
    Route::group(['prefix' => 'mountains', 'middleware' => 'checkUserLogin'], function () {

        Route::get('/', [MountainPageController::class, 'index']);
        Route::get('/detail', [MountainPageController::class, 'detail']);
        Route::get('/search', [MountainPageController::class, 'searchMountain'])->name('searchMountain');


    });
    Route::group(['prefix' => 'blogs', 'middleware' => 'checkUserLogin'], function () {
        Route::get('/', [ArticlePageController::class, 'index']);
        Route::get('/detail', [ArticlePageController::class, 'detail']);
        Route::get('/search', [ArticlePageController::class, 'searchArticle'])->name('searchArticle');

    });
    Route::group(['prefix' => 'organizations', 'middleware' => 'checkUserLogin'], function () {
        Route::get('/', [GroupPageController::class, 'index']);
        Route::get('/detail', [GroupPageController::class, 'detail']);
        Route::get('/search', [GroupPageController::class, 'searchGroup'])->name('searchGroup');
    });
    Route::group(['prefix' => 'aboutus', 'middleware' => 'checkUserLogin'], function () {
        Route::get('/', [AboutusPageController::class, 'index']);
        Route::get('/detail', [AboutusPageController::class, 'detail']);

    });
    Route::group(['prefix' => 'contact', 'middleware' => 'checkUserLogin'], function () {
        Route::get('/', [ContactPageController::class, 'index']);
        Route::post('/send', [ContactPageController::class, 'send'])->middleware('throttle:1,1'); //->middleware('throttle:3,1440')
    });



});

// Route::get('/password-reset/{token}', function ($token) {
//     // Giả sử bạn đang gửi email cùng với token và email như query parameters
//     return view('password-reset', ['token' => $token, 'email' => request()->query('email')]);
// })->name('password.reset');
Route::get('/password-reset/{token}', function ($token) {
    // Lấy email từ query parameters
    $email = request()->query('email');

    $passwordResetToken = PasswordResetToken::where('email', $email)->first();

    if (!$passwordResetToken || !Hash::check($token, $passwordResetToken->token) || Carbon::parse($passwordResetToken->created_at)->lte(Carbon::now()->subMinutes(30))) {
        //abort(404);
    
        return redirect('/');
    }else{

        return view('password-reset', ['token' => $token, 'email' => request()->query('email')]);
    }

    
})->name('password.reset');
Route::post('/reset-password-custom', [NewPasswordController::class, 'processUpdate'])->name('password.customUpdate');
Route::get('/forgotpassword', [LoginPageController::class, 'forgotpassword']);