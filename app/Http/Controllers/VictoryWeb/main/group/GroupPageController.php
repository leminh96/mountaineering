<?php
namespace App\Http\Controllers\VictoryWeb\main\group;

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
use App\Models\accounts\Rate_Mountains;
use App\Models\accounts\Rate_Groups;


use App\Models\accounts\Like_Groups;

use Illuminate\Http\Request;

class GroupPageController extends Controller
{
    public function index()
    {
        $groupLikeList = null;
        if (session()->has('user')) {
            $groupLikeList = Like_Groups::where('user_id', session()->get('user')->id)->get();
        }

        $scoreList = DB::table('rates_groups')
        ->select('group_id', DB::raw('
            CASE
                WHEN AVG(rate_score) - FLOOR(AVG(rate_score)) > 0.5 THEN CEILING(AVG(rate_score))
                ELSE FLOOR(AVG(rate_score))
            END AS avg_score
        '))
        ->groupBy('group_id')
        ->get();

        $topRates = DB::table('rates_groups')
        ->select('group_id','grouporgclub.id','grouporgclub.name','grouporgclub.photo', DB::raw('
            CASE
                WHEN AVG(rate_score) - FLOOR(AVG(rate_score)) > 0.5 THEN CEILING(AVG(rate_score))
                ELSE FLOOR(AVG(rate_score))
            END AS avg_score
        '))
        ->join('grouporgclub','grouporgclub.id','=','rates_groups.group_id')
        ->groupBy('group_id','grouporgclub.id','grouporgclub.name','grouporgclub.photo')
        ->orderBy('avg_score','DESC')
        ->limit(10)
        ->get();


        $data = [
            'cityList' => City::get(),
            'groupList' => DB::table('grouporgclub')
                ->select('grouporgclub.*', 'cities.name as city_name')
                ->leftjoin('cities', 'cities.id', '=', 'grouporgclub.city_id')
                ->where('deactivated', 0)->get(),
            'groupLikeList'=>$groupLikeList,
            'scoreList' => $scoreList,
            'topRates' => $topRates,
            'groupCount'=>Groups::where('deactivated', 0)->count(),
            'groupAlllike'=>Like_Groups::count()
        ];


        return view('VictoryWeb/main-page/group-page/index')->with($data);
    }
    public function detail(Request $request)
    {
        $id = $request->get('id');
        $commentList=DB::table('comments')
        ->select('comments.*','user.fullname','user.photo','user.id')
        ->join('user','user.id','=','comments.user_id')
        ->where('group_id',$id)
        ->orderBy('created','DESC')
        ->get();

        $scoreList = DB::table('rates_groups')
        ->select('group_id', DB::raw('
            CASE
                WHEN AVG(rate_score) - FLOOR(AVG(rate_score)) > 0.5 THEN CEILING(AVG(rate_score))
                ELSE FLOOR(AVG(rate_score))
            END AS avg_score
        '))
        ->where('group_id',$id)
        ->groupBy('group_id')
        ->first();

        if ($id == null) {
            return redirect('/blogs');
        }
        $group = Groups::where('id', $id)->where('deactivated', 0)->first();
        if ($group == null) {
            return redirect('/organizations');
        }
        $groupLikeList = null;
        if (session()->has('user')) {
            $groupLikeList = Like_Groups::where('user_id', session()->get('user')->id)->get();
        }
        $score=null;
        if (session()->has('user')) {
            $score = Rate_Groups::where('user_id', session()->get('user')->id)->where('group_id',$id)->first();
        }

        $mountainList = DB::table('mountains')
            ->join('grouporgclub_mountain', 'mountains.id', '=', 'grouporgclub_mountain.mountain_id')
            ->select('mountains.id', 'mountains.name', 'mountains.photo_main')
            ->where('grouporgclub_mountain.group_id', $id)
            ->where('deactivated', 0)
            ->groupBy('mountains.id', 'mountains.name', 'mountains.photo_main')
            ->get();


        $data = [
            'group' => $group,
            'mountainList' => $mountainList,
            'groupLikeList'=>$groupLikeList,
            'score' => $score ,
            'scoreList' => $scoreList,
            'commentList' =>$commentList
        ];
        return view('VictoryWeb/main-page/group-page/detail')->with($data);
    }
    public function searchGroup(Request $request){
        $checkedLocations = $request->input('checkedLocations');
        $groupList= DB::table('grouporgclub')
        ->select('grouporgclub.*', 'cities.name as city_name')
        ->leftjoin('cities', 'cities.id', '=', 'grouporgclub.city_id')
        ->where('deactivated', 0)->get();
        if($checkedLocations != null){
            $groupList = DB::table('grouporgclub')
            ->select('grouporgclub.*', 'cities.name as city_name')
            ->leftjoin('cities', 'cities.id', '=', 'grouporgclub.city_id')
            ->whereIn('city_id',$checkedLocations)
            ->where('deactivated', 0)->get();
        }

        $scoreList = DB::table('rates_groups')
        ->select('group_id', DB::raw('
            CASE
                WHEN AVG(rate_score) - FLOOR(AVG(rate_score)) > 0.5 THEN CEILING(AVG(rate_score))
                ELSE FLOOR(AVG(rate_score))
            END AS avg_score
        '))
        ->groupBy('group_id')
        ->get();

        $groupLikeList = null;
        if (session()->has('user')) {
            $groupLikeList = Like_Groups::where('user_id', session()->get('user')->id)->get();
        }

                return response()->json(array(
                    'groupList'=>$groupList,
                    'groupLikeList'=>$groupLikeList,
                    'scoreList' =>$scoreList
                ), 200);
    }

}
?>