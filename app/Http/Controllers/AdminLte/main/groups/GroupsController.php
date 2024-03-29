<?php
namespace App\Http\Controllers\AdminLte\main\groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\mountains\Mountains;
use App\Models\mountains\Mountains_photo;
use App\Models\mountains\Mountains_video;
use App\Models\accounts\Accounts;
use App\Models\groups\Groups;
use App\Models\groups\Group_mountain;
use App\Models\location\Country;
use App\Models\location\City;
use App\Models\location\Country_mountain;
use App\Models\emails\Emails;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class GroupsController extends Controller
{
    public function index(Request $request)
    {
        // $data=[
        //     'mountainsList' => Mountains::get(),
        //     'countryList' => Country::get()
        // ];
        $data = [
            'citiesList' => City::get(),
            'mountainsList' => Mountains::get(),
            'groupsList' => DB::table('grouporgclub')
                ->select('grouporgclub.*', 'cities.name as cityName')
                ->leftJoin('cities', 'grouporgclub.city_id', '=', 'cities.id')
                ->orderby('grouporgclub.deactivated', 'ASC')
                ->orderby('grouporgclub.id', 'ASC')
                ->get(),
            'mountainList' => DB::table('grouporgclub_mountain')
                ->select('mountains.*', 'grouporgclub_mountain.group_id')
                ->join('mountains', 'grouporgclub_mountain.mountain_id', '=', 'mountains.id')
                ->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()

        ];


        return view('AdminLte/main-page/groups/table')->with($data);
    }

    public function activate(Request $request)
    {
        $button = $request->get('button');
        if ($button != null) {
            if ($button == 'activate') {
                $data = [
                    'deactivated' => 0
                ];
                Groups::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Activate Organization Successfully !', 'Organization id "' . $request->get('id') . '" has been activate in to database');

            } else if ($button == 'deactivate') {
                $data = [
                    'deactivated' => 1
                ];
                Groups::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Deactivate Article Successfully !', 'Organization id "' . $request->get('id') . '" has been deactivate in to database');

            }
        }

        $currentUrl = $request->get('currentUrl');
        if ($currentUrl != null) {

            return redirect($currentUrl);
        }


        return redirect('/admin/groups/table');
    }
    public function addForm()
    {
        $data = [
            'citiesList' => City::get(),
            'mountainsList' => Mountains::get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        return view('AdminLte/main-page/groups/add')->with($data);
    }
    public function proccessAdd(Request $request)
    {

        $button = $request->get('button');
        if ($button != null && $button == 'add') {
            $name = $request->input('name');
            $leader = $request->input('leader');
            $description = $request->get('description');
            $contact = $request->get('contact');
            $city_id = $request->get('cityId');
            $api = $request->get('api');
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
                $groups = new Groups();
                $groups->name = $name;
                $groups->photo = $mainPhotoName;
                $groups->leader_name = $leader;
                $groups->description = $description;
                $groups->contact = $contact;
                $groups->api = $api;
                $groups->city_id = $city_id == -1 ? null : $city_id;
                $groups->deactivated = $deactivated;

                // Thêm các trường khác tương ứng
                $groups->save();

                $groupId = (int) $groups->id;


                $groupPath = public_path('img/groups/' . $groupId);

                if (!File::isDirectory($groupPath)) {
                    File::makeDirectory($groupPath, 0755, true, true);
                }
                if ($request->hasFile('main-photo')) {
                    $main_photo = $request->file('main-photo');

                    $main_photo->move(public_path('img/groups/' . $groupId), $mainPhotoName);

                }



                $mountains = $request->get('mountains');
                if ($mountains != null) {
                    foreach ($mountains as $mountain) {

                        Group_mountain::create([
                            'mountain_id' => $mountain,
                            'group_id' => $groupId
                        ]);

                    }
                    ;
                }

                DB::commit();
                $this->messMaker('success', 'Add Organization Successfully !', 'Organization id "' . $groupId . '" has been add in to database');

                return redirect('/admin/groups/table');
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
            $leader = $request->input('leader');
            $description = $request->get('description');
            $contact = $request->get('contact');
            $city_id = $request->get('cityId');
            $api = $request->get('api');




            DB::beginTransaction();
            $main_photo = $request->file('main-photo');
            if ($main_photo == null) {
                $mainPhotoName = null;
            } else {
                $mainPhotoName = now()->timestamp . "_" . $main_photo->getClientOriginalName();
            }
            try {
                // Thêm dữ liệu vào bảng Mountain
                $groups = Groups::find($id);
                $groups->name = $name;
                if ($main_photo != null) {
                    $groups->photo = $mainPhotoName;
                }
                //$groups->photo = $mainPhotoName;
                $groups->leader_name = $leader;
                $groups->description = $description;
                $groups->contact = $contact;
                $groups->api = $api;
                $groups->city_id = $city_id == -1 ? null : $city_id;

                // Thêm các trường khác tương ứng
                $groups->save();

                $groupId = (int) $groups->id;


                $groupPath = public_path('img/groups/' . $groupId);

                if (!File::isDirectory($groupPath)) {
                    File::makeDirectory($groupPath, 0755, true, true);
                }
                if ($request->hasFile('main-photo')) {
                    $main_photo = $request->file('main-photo');

                    $main_photo->move(public_path('img/groups/' . $groupId), $mainPhotoName);

                }



                $mountains = $request->get('mountains');
                Group_mountain::where('group_id', $id)->delete();
                if ($mountains != null) {
                    foreach ($mountains as $mountain) {

                        Group_mountain::create([
                            'mountain_id' => $mountain,
                            'group_id' => $groupId
                        ]);

                    }
                    ;
                }

                DB::commit();
                $this->messMaker('success', 'Update Organization Successfully !', 'Organization id "' . $groupId . '" has been update in to database');

                return redirect('/admin/groups/table');
            } catch (\Exception $e) {
                $data = [
                    'exception' => $e->getMessage()
                ];
                return view('AdminLte/main-page/mountains/test')->with($data);
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
            'citiesList' => City::get(),
            'mountainsList' => Mountains::get(),
            'group' => DB::table('grouporgclub')
                ->select('grouporgclub.*', 'cities.name as cityName')
                ->leftJoin('cities', 'grouporgclub.city_id', '=', 'cities.id')
                ->where('grouporgclub.id', $id)
                ->first(),
            'mountainList' => DB::table('grouporgclub_mountain')
                ->select('mountains.*', 'grouporgclub_mountain.group_id')
                ->join('mountains', 'grouporgclub_mountain.mountain_id', '=', 'mountains.id')
                ->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        return view('AdminLte/main-page/groups/detail')->with($data);
    }
    public function rateGroups()
    {

        $groupsList = Groups::orderby('deactivated', 'ASC')->orderby('id', 'ASC')->get();
        // foreach ($groupsList as $group) {
        //     // Tính trung bình điểm đánh giá và lưu vào thuộc tính của mỗi đối tượng ngọn núi
        //     $group->averageRating = Rate_Groups::where('group_id', $group->id)->avg('rate_score') ?? 0;
        // }

        $groupsList = DB::table('grouporgclub')
            ->select("grouporgclub.id", 'grouporgclub.name', 'grouporgclub.photo', DB::raw('ROUND(AVG(rates_groups.rate_score), 0) as averageRating'))
            ->leftJoin("rates_groups", 'rates_groups.group_id', '=', 'grouporgclub.id')
            ->groupBy("grouporgclub.id", 'grouporgclub.name', 'grouporgclub.photo')
            ->orderBy('grouporgclub.deactivated', 'ASC')
            ->orderBy('averageRating', 'DESC')
            ->get();

        // Chỉ cần gửi danh sách ngọn núi đến view, mỗi ngọn núi giờ đã có thêm thuộc tính trung bình điểm đánh giá
        $data = [
            'groupsList' => $groupsList,
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'notify' => Emails::where('status', 0)->orderBy('id', 'DESC')->count(),
            'emailNotify' => Emails::where('status', 0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        return view('AdminLte/main-page/rating/rateGroups')->with($data);
    }


    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }




}


