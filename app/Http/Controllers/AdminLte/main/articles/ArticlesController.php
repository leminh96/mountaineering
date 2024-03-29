<?php
namespace App\Http\Controllers\AdminLte\main\articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\emails\Emails;




class ArticlesController extends Controller
{
    public function index(Request $request)
    {

        $data = [
            'articlesList' => Articles::orderby('deactivated', 'ASC')->orderby('id', 'ASC')->get(),
            'categoriesList' => Categories::get(),
            'mountainsList' => Mountains::get(),
            'categoryList' => DB::table('article_category')
                ->select('category.*', 'article_category.article_id')
                ->join('category', 'article_category.category_id', '=', 'category.id')
                ->get(),
            'mountainList' => DB::table('article_mountain')
                ->select('mountains.*', 'article_mountain.article_id')
                ->join('mountains', 'article_mountain.mountain_id', '=', 'mountains.id')
                ->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];


        return view('AdminLte/main-page/articles/table')->with($data);
    }

    public function activate(Request $request)
    {
        $button = $request->get('button');
        if ($button != null) {
            if ($button == 'activate') {
                $data = [
                    'deactivated' => 0
                ];
                Articles::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Activate Article Successfully !', 'Article id "' . $request->get('id') . '" has been activate in to database');

            } else if ($button == 'deactivate') {
                $data = [
                    'deactivated' => 1
                ];
                Articles::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Deactivate Article Successfully !', 'Article id "' . $request->get('id') . '" has been deactivate in to database');

            }
        }

        $currentUrl = $request->get('currentUrl');
        if ($currentUrl != null) {

            return redirect($currentUrl);
        }

        return redirect('/admin/articles/table');
    }
    public function addForm()
    {
        $data = [
            'categoriesList' => Categories::get(),
            'mountainsList' => Mountains::get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()

        ];

        return view('AdminLte/main-page/articles/add')->with($data);
    }
    public function proccessAdd(Request $request)
    {

        $button = $request->get('button');
        if ($button != null && $button == 'add') {
            $name = $request->input('name');
            $description = $request->get('description');
            $deactivated = $request->has('status') ? 0 : 1;




            DB::beginTransaction();
            $main_photo = $request->file('main-photo');
            if ($main_photo == null) {
                $mainPhotoName = null;
            } else {
                $mainPhotoName = now()->timestamp . "_" . $main_photo->getClientOriginalName();
            }
            try {
                // Thêm dữ liệu vào bảng Mountain
                $article = new Articles();
                $article->name = $name;
                $article->photo = $mainPhotoName;
                $article->description = $description;
                $article->deactivated = $deactivated;
                $article->created = Carbon::now()->format('Y-m-d');

                // Thêm các trường khác tương ứng
                $article->save();

                $articleId = (int) $article->id;


                $articlePath = public_path('img/articles/' . $articleId);

                if (!File::isDirectory($articlePath)) {
                    File::makeDirectory($articlePath, 0755, true, true);
                }
                if ($request->hasFile('main-photo')) {
                    $main_photo = $request->file('main-photo');

                    $main_photo->move(public_path('img/articles/' . $articleId), $mainPhotoName);

                }


                $categories = $request->get('categories');
                if ($categories != null) {
                    foreach ($categories as $category) {

                        Article_category::create([
                            'category_id' => $category,
                            'article_id' => $articleId
                        ]);

                    }
                    ;
                }
                $mountains = $request->get('mountains');
                if ($mountains != null) {
                    foreach ($mountains as $mountain) {

                        Article_mountain::create([
                            'mountain_id' => $mountain,
                            'article_id' => $articleId
                        ]);

                    }
                    ;
                }

                DB::commit();
                $this->messMaker('success', 'Add Article Successfully !', 'Article id "' . $articleId . '" has been add in to database');

                return redirect('/admin/articles/table');
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect('/admin/accounts/table');
    }


    public function proccessUpdate(Request $request)
    {

        $button = $request->get('button');

        if ($button != null && $button == 'update') {
            $id = $request->input('id');
            $name = $request->input('name');
            $description = $request->get('description');

            DB::beginTransaction();
            $main_photo = $request->file('main-photo');
            if ($main_photo == null) {
                $mainPhotoName = null;
            } else {
                $mainPhotoName = now()->timestamp . "_" . $main_photo->getClientOriginalName();
            }
            try {
                // Thêm dữ liệu vào bảng Mountain
                $article = Articles::find($id);
                $article->name = $name;
                if ($main_photo != null) {
                    $article->photo = $mainPhotoName;
                }
                //$article->photo = $mainPhotoName;
                $article->description = $description;
                //$article->created = Carbon::now()->format('Y-m-d');

                // Thêm các trường khác tương ứng
                $article->save();

                $articleId = (int) $article->id;


                $articlePath = public_path('img/articles/' . $articleId);

                if (!File::isDirectory($articlePath)) {
                    File::makeDirectory($articlePath, 0755, true, true);
                }
                if ($request->hasFile('main-photo')) {

                    $main_photo = $request->file('main-photo');

                    $main_photo->move(public_path('img/articles/' . $articleId), $mainPhotoName);

                }


                $categories = $request->get('categories');
                Article_category::where('article_id', $id)->delete();
                if ($categories != null) {
                    foreach ($categories as $category) {

                        Article_category::create([
                            'category_id' => $category,
                            'article_id' => $articleId
                        ]);

                    }
                    ;
                }
                $mountains = $request->get('mountains');
                Article_mountain::where('article_id', $id)->delete();
                if ($mountains != null) {
                    foreach ($mountains as $mountain) {

                        Article_mountain::create([
                            'mountain_id' => $mountain,
                            'article_id' => $articleId
                        ]);

                    }
                    ;
                }

                DB::commit();
                $this->messMaker('success', 'Update Article Successfully !', 'Article id "' . $articleId . '" has been update in to database');

                return redirect('/admin/articles/table');
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect('/admin/accounts/table');
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        $data = [
            'article' => Articles::where('id', $id)->first(),
            'categoriesList' => Categories::get(),
            'mountainsList' => Mountains::get(),
            'categoryList' => DB::table('article_category')
                ->select('category.*', 'article_category.article_id')
                ->join('category', 'article_category.category_id', '=', 'category.id')
                ->get(),
            'mountainList' => DB::table('article_mountain')
                ->select('mountains.*', 'article_mountain.article_id')
                ->join('mountains', 'article_mountain.mountain_id', '=', 'mountains.id')
                ->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        return view('AdminLte/main-page/articles/detail')->with($data);
    }

    public function getCurrentInfo(Request $request)
    {
        $id = $request->get('id');
        $article = Articles::where('id', $id)->first();


        return response()->json(
            array(
                'article' => $article

            ),
            200
        );


    }

    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }





}


