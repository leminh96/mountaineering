<?php
namespace App\Http\Controllers\VictoryWeb\main\home;

use App\Http\Controllers\Controller;


use App\Models\mountains\Mountains;
use App\Models\mountains\Mountains_photo;
use App\Models\mountains\Mountains_video;
use App\Models\accounts\Accounts;
use App\Models\articles\Articles;
use App\Models\articles\Categories;
use App\Models\articles\Article_category;
use App\Models\articles\Article_mountain;
use App\Models\groups\Groups;
use App\Models\groups\Group_mountain;
use App\Models\location\City;
use App\Models\location\Country_mountain;
use App\Models\location\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class HomePageController extends Controller
{
    public function index()
    {
        
        $seenUserIds = [];
        $accountRateList = [];
        $rateList = DB::table('rates_mountains')
            ->select('mountain_id', 'mountains.id as mountainId', 'mountains.name as mountainName', 'user.id', 'user.fullname', 'user.photo', DB::raw('
            CASE
                WHEN AVG(rate_score) - FLOOR(AVG(rate_score)) > 0.5 THEN CEILING(AVG(rate_score))
                ELSE FLOOR(AVG(rate_score))
            END AS avg_score
        '))
            ->join('mountains', 'mountains.id', '=', 'rates_mountains.mountain_id')
            ->join('user', 'user.id', '=', 'rates_mountains.user_id')
            ->groupBy('mountain_id', 'mountains.id', 'mountains.name', 'user.id', 'user.fullname', 'user.photo')
            ->having('avg_score', 5)
            ->where('user.deactivated', 0)
            ->inRandomOrder()
            ->get();

        foreach ($rateList as $item) {
            $userId = $item->id;
            $mountainId = $item->mountainId;

            if (!in_array($userId, $seenUserIds)) {
                // Thêm dòng vào kết quả lọc
                $accountRateList[] = $item;
                // Thêm userId vào danh sách đã xem
                $seenUserIds[] = $userId;
            }
        }




        $data = [
            'mountainList' => DB::table('mountains')
                ->select('mountains.id', 'mountains.name', 'mountains.photo_main', 'countries.name as country_name')
                ->join('country_mountain', 'mountains.id', '=', 'country_mountain.mountain_id')
                ->join('countries', 'country_mountain.country_id', '=', 'countries.id')
                ->where('mountains.deactivated', 0)
                ->groupBy('mountains.id', 'mountains.name', 'countries.name', 'mountains.photo_main')
                ->havingRaw('COUNT(DISTINCT country_mountain.country_id) = 1')
                ->inRandomOrder()
                ->limit(20)
                ->get(),
            'articleFirst' => Articles::orderBy('created', 'DESC')->where('deactivated', 0)->first(),
            'articleSecond' => Articles::orderBy('created', 'DESC')->where('deactivated', 0)->skip(1)->take(3)->get(),
            'articleThird' => Articles::orderBy('created', 'DESC')->where('deactivated', 0)->skip(4)->take(10)->get(),
            'groupList' => Groups::inRandomOrder()
            ->where('deactivated', 0)
            ->limit(20)
                ->get(),
            'accountRateList' => $accountRateList
        ];
        return view('VictoryWeb/main-page/home-page/index')->with($data);
    }
    public function detail()
    {

        $data = [
            'category' => Categories::get(),
            'article' => Articles::where('deactivated', 0)->get(),
            'featuredNews' => Articles::orderBy('id', 'desc')->first(),
            'otherNews' => Articles::orderBy('id', 'desc')->skip(1)->take(3)->get()
        ];
        return view('VictoryWeb/main-page/home-page/detail')->with($data);
    }

}
?>