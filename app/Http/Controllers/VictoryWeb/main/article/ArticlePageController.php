<?php
namespace App\Http\Controllers\VictoryWeb\main\article;

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

use App\Models\accounts\Like_Articles;

use Illuminate\Http\Request;

class ArticlePageController extends Controller
{
    public function index()
    {
        $articleFirst = Articles::where('deactivated', 0)->orderBy('created', 'DESC')->first();
        $articleSecond = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->select('article.*')
            ->where('article.id', '!=', $articleFirst->id)
            ->where('deactivated', 0)
            ->groupBy('article.id', 'article.name', 'article.photo', 'article.description', 'article.created', 'article.deactivated')
            ->havingRaw('COUNT(article_category.category_id) >= 2')
            ->orderBy('article.created', 'desc')
            ->limit(30)
            ->get();

        $articleOneCategory = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->select('article.id')
            ->where('article.id', '!=', $articleFirst->id)
            ->where('deactivated', 0)
            ->groupBy('article.id')
            ->havingRaw('COUNT(article_category.category_id) = 1')
            ->orderBy('article.created', 'desc')
            ->get();
        $oneCategoryIdList = $articleOneCategory->pluck('id');
        $articleGuides = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->select('article.*')
            ->where('article.id', '!=', $articleFirst->id)
            ->where('deactivated', 0)
            ->whereIn('article.id', $oneCategoryIdList)
            ->where('article_category.category_id', 2)
            ->orderBy('article.created', 'desc')
            ->limit(2)
            ->get();
        $articleStyle = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->select('article.*')
            ->where('article.id', '!=', $articleFirst->id)
            ->where('deactivated', 0)
            ->whereIn('article.id', $oneCategoryIdList)
            ->where('article_category.category_id', 3)
            ->orderBy('article.created', 'desc')
            ->limit(2)
            ->get();
        $articleHistory = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->select('article.*')
            ->where('article.id', '!=', $articleFirst->id)
            ->where('deactivated', 0)
            ->whereIn('article.id', $oneCategoryIdList)
            ->where('article_category.category_id', 4)
            ->orderBy('article.created', 'desc')
            ->limit(2)
            ->get();
        $articleSheltering = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->select('article.*')
            ->where('article.id', '!=', $articleFirst->id)
            ->where('deactivated', 0)
            ->whereIn('article.id', $oneCategoryIdList)
            ->where('article_category.category_id', 5)
            ->orderBy('article.created', 'desc')
            ->limit(2)
            ->get();
        $articleDangers = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->select('article.*')
            ->where('article.id', '!=', $articleFirst->id)
            ->where('deactivated', 0)
            ->whereIn('article.id', $oneCategoryIdList)
            ->where('article_category.category_id', 6)
            ->orderBy('article.created', 'desc')
            ->limit(2)
            ->get();
        $data = [
            'articleFirst' => $articleFirst,
            'articleSecond' => $articleSecond,
            'articleGuides' => $articleGuides,
            'articleStyle' => $articleStyle,
            'articleHistory' => $articleHistory,
            'articleSheltering' => $articleSheltering,
            'articleDangers' => $articleDangers,

            'categoryList' => Categories::get()

        ];
        return view('VictoryWeb/main-page/article-page/index')->with($data);
    }
    public function detail(Request $request)
    {
        $id = $request->get('id');
        $commentList=DB::table('comments')
        ->select('comments.*','user.fullname','user.photo','user.id')
        ->join('user','user.id','=','comments.user_id')
        ->where('article_id',$id)
        ->orderBy('created','DESC')
        ->get();
        if ($id == null) {
            return redirect('/blogs');
        }
        $article = Articles::where('id', $id)->where('deactivated', 0)->first();
        if ($article == null) {
            return redirect('/blogs');
        }
        $articleLikeList = null;
        if (session()->has('user')) {
            $articleLikeList = Like_Articles::where('user_id', session()->get('user')->id)->get();
        }

        $categories = DB::table('article_category')
            ->where('article_id', $id)
            ->pluck('category_id')
            ->toArray();

        // Truy vấn các bài viết thuộc các danh mục có id trong mảng $categories
        $relatedArticles = DB::table('article')

            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->whereIn('article_category.category_id', $categories)
            ->where('article.id', '!=', $id) // Loại trừ bài viết hiện tại
            ->where('deactivated', 0)
            ->select('article.*')
            ->groupBy('article.id', 'article.name', 'article.photo', 'article.description', 'article.created', 'article.deactivated')
            ->get();

        $data = [
            'article' => $article,
            'articleRelatedList' => $relatedArticles,
            'articleLikeList' => $articleLikeList,
            'commentList'=> $commentList

        ];
        return view('VictoryWeb/main-page/article-page/detail')->with($data);
    }
    public function searchArticle(Request $request)
    {
        $checkedLocations = $request->input('checkedLocations');
        $articleList = null;
        if ($checkedLocations != null) {
            $articleList = DB::table('article')
            ->join('article_category', 'article.id', '=', 'article_category.article_id')
            ->whereIn('article_category.category_id', $checkedLocations)
            ->where('deactivated', 0)
            ->select('article.*')
            ->groupBy('article.id', 'article.name', 'article.photo', 'article.description', 'article.created', 'article.deactivated')
            ->get();
        }

        // $scoreList = DB::table('rates_groups')
        //     ->select('group_id', DB::raw('
        //     CASE
        //         WHEN AVG(rate_score) - FLOOR(AVG(rate_score)) > 0.5 THEN CEILING(AVG(rate_score))
        //         ELSE FLOOR(AVG(rate_score))
        //     END AS avg_score
        // '))
        //     ->groupBy('group_id')
        //     ->get();

        // $groupLikeList = null;
        // if (session()->has('user')) {
        //     $groupLikeList = Like_Groups::where('user_id', session()->get('user')->id)->get();
        // }

        return response()->json(
            array(
                'articleList' => $articleList
            ), 200);
    }

}
?>