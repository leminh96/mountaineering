<?php
namespace App\Http\Controllers\VictoryWeb\main\mountain;

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
use App\Models\accounts\Like_Mountains;
use App\Models\accounts\Like_Groups;

use App\Models\accounts\Rate_Mountains;
use App\Models\accounts\Rate_Groups;
use Illuminate\Http\Request;
use Carbon\Carbon;


class MountainPageController extends Controller
{
    public function index()
    {   

        $mountainLikeList = null;
        if (session()->has('user')) {
            $mountainLikeList = Like_Mountains::where('user_id', session()->get('user')->id)->get();
        }
        $data = [
            'mountainList' => Mountains::where('deactivated', 0)->paginate(10),
            'countryList' => DB::table('country_mountain')
                ->select('countries.id', 'countries.name')
                ->join('countries', 'countries.id', '=', 'country_mountain.country_id')
                ->groupBy('countries.id', 'countries.name')
                ->get(),
            'articleList' => DB::table('article')
                ->join('article_mountain', 'article_mountain.article_id', '=', 'article.id')
                ->select('article.*')
                ->where('deactivated', 0)
                ->groupBy('article.id', 'article.name', 'article.photo', 'article.description', 'article.created', 'article.deactivated')
                ->inRandomOrder()
                ->limit(15)
                ->get(),
            'mountainLikeList' => $mountainLikeList,
            'mountainAlllike'=>Like_Mountains::count(),
            'mountainsCount'=>Mountains::where('deactivated', 0)->count()
        ];

        return view('VictoryWeb/main-page/mountain-page/index')->with($data);
    }
    public function detail(Request $request)
    {
        $id = $request->get('id');

        $commentList=DB::table('comments')
        ->select('comments.*','user.fullname','user.photo','user.id')
        ->join('user','user.id','=','comments.user_id')
        ->where('mountain_id',$id)
        ->orderBy('created','DESC')
        ->get();

        $groupLikeList = null;
        if (session()->has('user')) {
            $groupLikeList = Like_Groups::where('user_id', session()->get('user')->id)->get();
        }
        
        $scoreList = DB::table('rates_mountains')
        ->select('mountain_id', DB::raw('
            CASE
                WHEN AVG(rate_score) - FLOOR(AVG(rate_score)) > 0.5 THEN CEILING(AVG(rate_score))
                ELSE FLOOR(AVG(rate_score))
            END AS avg_score
        '))
        ->where('mountain_id',$id)
        ->groupBy('mountain_id')
        ->first();

        if ($id == null) {
            return redirect('/mountains');
        }

        $mountain = Mountains::where('id', $id)->where('deactivated', 0)->first();
        if ($mountain == null) {
            return redirect('/mountains');
        }

        $mountainLikeList = null;
        if (session()->has('user')) {
            $mountainLikeList = Like_Mountains::where('user_id', session()->get('user')->id)->get();
        }

        $score=null;
        if (session()->has('user')) {
            $score = Rate_Mountains::where('user_id', session()->get('user')->id)->where('mountain_id',$id)->first();


        }
        $data = [
            'mountain' => $mountain,
            'photoList' => Mountains_photo::where('mountain_id', $id)->get(),
            'videoList' => Mountains_video::where('mountain_id', $id)->get(),
            'articleList' => DB::table('article_mountain')
                ->select('*')
                ->join('article', 'article.id', '=', 'article_mountain.article_id')
                ->where('article_mountain.mountain_id', $id)
                ->limit(10)
                ->get(),
            'groupList' => DB::table('grouporgclub_mountain')
                ->select('*')
                ->join('grouporgclub', 'grouporgclub.id', '=', 'grouporgclub_mountain.group_id')
                ->where('grouporgclub_mountain.mountain_id', $id)
                ->limit(10)
                ->get(),
            'mountainLikeList' => $mountainLikeList,
            'score'=> $score,
            'scoreList'=> $scoreList,
            'groupLikeList'=>$groupLikeList,
            'commentList' => $commentList

        ];
        return view('VictoryWeb/main-page/mountain-page/detail')->with($data);
    }

    public function searchMountain(Request $request){
        $checkedLocations = $request->input('checkedLocations');
        $mountainList= Mountains::where('deactivated', 0)->get();
        if($checkedLocations != null){
            $mountainList = DB::table('mountains')
            ->select('mountains.id', 'mountains.name', 'mountains.photo_main')
            ->join('country_mountain', 'mountains.id', '=', 'country_mountain.mountain_id')
            ->join('countries', 'country_mountain.country_id', '=', 'countries.id')
            ->where('mountains.deactivated', 0)
            ->whereIn('countries.id',$checkedLocations)
            ->groupBy('mountains.id', 'mountains.name', 'mountains.photo_main')
            ->get();
        }
        $mountainLikeList = null;
        if (session()->has('user')) {
            $mountainLikeList = Like_Mountains::where('user_id', session()->get('user')->id)->get();
        }
        //session()->put('mountainSearchList');

                return response()->json(array(
                    'mountainList'=>$mountainList,
                    'mountainLikeList'=>$mountainLikeList
                ), 200);

    }


}
?>