<?php
namespace App\Http\Controllers\AdminLte\main\mountains;

use App\Http\Controllers\Controller;
use App\Models\location\City;
use Illuminate\Http\Request;
use App\Models\Accounts;
use App\Models\mountains\Mountains;
use App\Models\mountains\Mountains_photo;
use App\Models\mountains\Mountains_video;

use Illuminate\Support\Facades\DB;
use App\Models\location\Country;
use App\Models\location\Country_mountain;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\accounts\Rate_Mountains;
use App\Models\accounts\Rate_Groups;
use App\Models\emails\Emails;



class MountainsController extends Controller
{
    public function index(Request $request)
    {
        // $data=[
        //     'mountainsList' => Mountains::get(),
        //     'countryList' => Country::get()
        // ];
        $data = [
            'mountainsList' => Mountains::orderby('deactivated', 'ASC')->orderby('id', 'ASC')->get(),
            'photoList' => Mountains_photo::get(),
            'videoList' => Mountains_video::get(),
            'countriesList' => Country::get(),
            'countryList' => DB::table('countries')
                ->select('countries.*', 'country_mountain.mountain_id')
                ->join('country_mountain', 'country_mountain.country_id', '=', 'countries.id')
                ->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()

        ];

        return view('AdminLte/main-page/mountains/table')->with($data);
    }

    public function activate(Request $request)
    {
        $button = $request->get('button');
        if ($button != null) {
            if ($button == 'activate') {
                $data = [
                    'deactivated' => 0
                ];
                Mountains::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Activate Mountain Successfully !', 'Mountain id "' . $request->get('id') . '" has been activate in to database');

            } else if ($button == 'deactivate') {
                $data = [
                    'deactivated' => 1
                ];
                Mountains::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Deactivate Mountain Successfully !', 'Mountain id "' . $request->get('id') . '" has been deactivate in to database');

            }
        }

        $currentUrl = $request->get('currentUrl');
        if ($currentUrl != null) {

            return redirect($currentUrl);
        }

        return redirect('/admin/mountains/table');
    }
    public function addForm()
    {
        $data = [
            'countriesList' => Country::get(),
            'mountainsList' => Mountains::get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        return view('AdminLte/main-page/mountains/add')->with($data);
    }


    public function proccessAdd(Request $request)
    {
        $button = $request->get('button');
        if ($button != null && $button == 'add') {
            $name = $request->input('mountain_name');
            $desciption = $request->get('description');
            $history = $request->get('history');
            $guides = $request->get('guides');
            $location = $request->get('location');
            $api = $request->get('api');
            $sheltering = $request->get('sheltering');
            $danger = $request->get('dangers');
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
                $mountain = new Mountains();
                $mountain->name = $name;
                $mountain->description = $desciption;
                $mountain->history = $history;
                $mountain->guides = $guides;
                $mountain->location = $location;
                $mountain->api = $api;
                $mountain->sheltering = $sheltering;
                $mountain->dangers = $danger;
                $mountain->photo_main = $mainPhotoName;
                $mountain->deactivated = $deactivated;
                // Thêm các trường khác tương ứng
                $mountain->save();

                $mountainId = (int) $mountain->id;


                $mountainPath = public_path('img/mountains/' . $mountainId);

                if (!File::isDirectory($mountainPath)) {
                    File::makeDirectory($mountainPath, 0755, true, true);
                }
                if ($request->hasFile('main-photo')) {
                    $main_photo = $request->file('main-photo');


                    $main_photo->move(public_path('img/mountains/' . $mountainId), $mainPhotoName);


                    try {
                        $add_photo = [
                            "name" => $mainPhotoName,
                            'mountain_id' => $mountainId
                        ];
                        Mountains_photo::create($add_photo);
                    } catch (\Exception $e) {
                        $data = [
                            'exception' => $e->getMessage()
                        ];
                        return view('AdminLte/main-page/mountains/test')->with($data);
                    }

                }

                // Thêm dữ liệu vào bảng MountainPhoto
                if ($request->hasFile('related-photo')) {
                    foreach ($request->file('related-photo') as $photo) {
                        $timestamp = now()->timestamp;
                        $filename = $photo->getClientOriginalName();
                        $newFileName = $timestamp . '_' . $filename; // Đổi tên file
                        $photo->move(public_path('img/mountains/' . $mountainId), $newFileName);


                        try {
                            $add_photo = [
                                "name" => $newFileName,
                                'mountain_id' => $mountainId
                            ];
                            Mountains_photo::create($add_photo);
                        } catch (\Exception $e) {
                            $data = [
                                'exception' => $e->getMessage()
                            ];
                            return view('AdminLte/main-page/mountains/test')->with($data);
                        }

                    }
                }

                if ($request->hasFile('video')) {
                    foreach ($request->file('video') as $video) {
                        $timestamp = now()->timestamp;
                        $vidname = $video->getClientOriginalName();
                        $newVidName = $timestamp . '_' . $vidname; // Đổi tên file
                        $video->move(public_path('img/mountains/' . $mountainId), $newVidName);

                        try {
                            $add_video = [
                                "name" => $newVidName,
                                'mountain_id' => $mountainId
                            ];
                            Mountains_video::create($add_video);
                        } catch (\Exception $e) {
                            $data = [
                                'exception' => $e->getMessage()
                            ];
                            return view('AdminLte/main-page/mountains/test')->with($data);
                        }

                    }
                }

                $countries = $request->get('countries');
                if ($countries != null) {
                    foreach ($countries as $country) {

                        Country_mountain::create([
                            'country_id' => $country,
                            'mountain_id' => $mountainId
                        ]);

                    }
                    ;
                }

                DB::commit();
                $this->messMaker('success', 'Add Mountain Successfully !', 'Mountain id "' . $mountainId . '" has been add in to database');

                return redirect('/admin/mountains/table');
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect('/admin/mountains/table');
    }


    public function proccessUpdate(Request $request)
    {
        $button = $request->get('button');
        if ($button != null && $button == 'update') {
            $id = $request->input('id');
            $name = $request->input('mountain_name');
            $desciption = $request->get('description');
            $history = $request->get('history');
            $guides = $request->get('guides');
            $location = $request->get('location');
            $api = $request->get('api');
            $sheltering = $request->get('sheltering');
            $danger = $request->get('dangers');
            $currentMainPhoto = $request->get('mainPhotoName');

            DB::beginTransaction();
            $finalMainPhoto = '';
            $main_photo = $request->file('main-photo');
            if ($main_photo == null) {
                $mainPhotoName = null;
            } else {
                $mainPhotoName = now()->timestamp . "_" . $main_photo->getClientOriginalName();
            }
            try {
                $mountain = Mountains::find($id);
                $mountain->name = $name;
                $mountain->description = $desciption;
                $mountain->history = $history;
                $mountain->guides = $guides;
                $mountain->location = $location;
                $mountain->api = $api;
                $mountain->sheltering = $sheltering;
                $mountain->dangers = $danger;
                if ($main_photo != null) {
                    $mountain->photo_main = $mainPhotoName;
                    $finalMainPhoto = $mainPhotoName;
                } else {
                    $mountain->photo_main = $currentMainPhoto;
                    $finalMainPhoto = $currentMainPhoto;
                }
                $mountain->save();

                $mountainId = (int) $mountain->id;


                $mountainPath = public_path('img/mountains/' . $mountainId);

                if (!File::isDirectory($mountainPath)) {
                    File::makeDirectory($mountainPath, 0755, true, true);
                }

                if ($request->hasFile('main-photo')) {

                    $main_photo = $request->file('main-photo');


                    $main_photo->move(public_path('img/mountains/' . $mountainId), $mainPhotoName);


                    try {
                        Mountains_photo::where('mountain_id', $id)->where('name', '=', $currentMainPhoto)->delete();
                        // 1708964694_Chopped-Salad-001_1.webp
                        // 1708964448_Chopped-Salad-001_1.webp

                        $add_photo = [
                            "name" => $mainPhotoName,
                            'mountain_id' => $mountainId
                        ];
                        echo $currentMainPhoto . '<br>' . $finalMainPhoto . '<br>';
                        Mountains_photo::create($add_photo);
                    } catch (\Exception $e) {
                        $data = [
                            'exception' => $e->getMessage()
                        ];
                        return view('AdminLte/main-page/mountains/test')->with($data);
                    }


                }

                // Thêm dữ liệu vào bảng MountainPhoto
                if ($request->hasFile('related-photo')) {
                    Mountains_photo::where('mountain_id', $id)->where('name', '!=', $finalMainPhoto)->delete();
                    foreach ($request->file('related-photo') as $photo) {
                        $timestamp = now()->timestamp;
                        $filename = $photo->getClientOriginalName();
                        $newFileName = $timestamp . '_related_' . $filename; // Đổi tên file
                        $photo->move(public_path('img/mountains/' . $mountainId), $newFileName);


                        try {
                            $add_photo = [
                                "name" => $newFileName,
                                'mountain_id' => $mountainId
                            ];
                            Mountains_photo::create($add_photo);
                        } catch (\Exception $e) {
                            $data = [
                                'exception' => $e->getMessage()
                            ];
                            return view('AdminLte/main-page/mountains/test')->with($data);
                        }


                    }
                }

                if ($request->hasFile('video')) {
                    Mountains_video::where('mountain_id', $id)->delete();
                    foreach ($request->file('video') as $video) {
                        $timestamp = now()->timestamp;
                        $vidname = $video->getClientOriginalName();
                        $newVidName = $timestamp . '_' . $vidname; // Đổi tên file
                        $video->move(public_path('img/mountains/' . $mountainId), $newVidName);

                        try {
                            $add_video = [
                                "name" => $newVidName,
                                'mountain_id' => $mountainId
                            ];
                            Mountains_video::create($add_video);
                        } catch (\Exception $e) {
                            $data = [
                                'exception' => $e->getMessage()
                            ];
                            return view('AdminLte/main-page/mountains/test')->with($data);
                        }

                    }
                }

                $countries = $request->get('countries');
                Country_mountain::where('mountain_id', $id)->delete();

                if ($countries != null) {

                    foreach ($countries as $country) {

                        Country_mountain::create([
                            'country_id' => $country,
                            'mountain_id' => $mountainId
                        ]);

                    }
                    ;
                }


                DB::commit();
                $this->messMaker('success', 'Update Mountain Successfully !', 'Mountain id "' . $mountainId . '" has been update in to database');

                return redirect('/admin/mountains/table');
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }

        }
        return redirect('/admin/mountains/table');
    }



    public function detail(Request $request)
    {
        $id = $request->get('id');
        $data = [
            'mountain' => Mountains::where('id', $id)->first(),
            'photoList' => Mountains_photo::get(),
            'videoList' => Mountains_video::get(),
            'countriesList' => Country::get(),
            'countryList' => DB::table('countries')
                ->select('countries.*', 'country_mountain.mountain_id')
                ->join('country_mountain', 'country_mountain.country_id', '=', 'countries.id')
                ->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        return view('AdminLte/main-page/mountains/detail')->with($data);
    }


    public function getCurrentInfo(Request $request)
    {
        $id = $request->get('id');
        $mountain = Mountains::where('id', $id)->first();
        $mountainName = $mountain->name;
        $photoList = Mountains_photo::where('mountain_id', $id)->get();
        $videoList = Mountains_video::where('mountain_id', $id)->get();

        return response()->json(
            array(
                'mountain' => $mountain,
                'mountainName' => $mountain->name
            ),
            200
        );


    }
    public function rateMountains()
    {

        $mountainsList = DB::table('mountains')
            ->select("mountains.id", 'mountains.name', 'mountains.photo_main', DB::raw('ROUND(AVG(rates_mountains.rate_score), 0) as averageRating'))
            ->leftJoin("rates_mountains", 'rates_mountains.mountain_id', '=', 'mountains.id')
            ->groupBy("mountains.id", 'mountains.name', 'mountains.photo_main')
            ->orderBy('mountains.deactivated', 'ASC')
            ->orderBy('averageRating', 'DESC')
            ->get();


            $data = [
            'mountainsList' => $mountainsList,
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];

        return view('AdminLte/main-page/rating/rateMountains')->with($data);
    }
    public function addCountry(Request $request)
    {
        $button = $request->get('button');
        if ($button != null && $button == 'addCountry') {
            $name = $request->get('name');
            
            DB::beginTransaction();

            try {
                // Thêm dữ liệu vào bảng Mountain
                $country = new Country();
                $country->name = $name;

                $country->save();

                DB::commit();
                $this->messMaker('success', 'Add Country Successfully !', 'Country name "' . $name . '" has been add in to database');

                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect()->back();
    }

    public function addCity(Request $request){
        $button = $request->get('button');
        if ($button != null && $button == 'addCity') {
            $name = $request->get('name');
            $countryId= $request->get('countryId');
            DB::beginTransaction();

            try {
                // Thêm dữ liệu vào bảng Mountain
                $city = new City();
                $city->name = $name;
                $city->country_id=$countryId;
                $city->save();

                DB::commit();
                $this->messMaker('success', 'Add City Successfully !', 'City name "' . $name . '" has been add in to database');

                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
            }


        }


        return redirect()->back();
    }

    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }





}


