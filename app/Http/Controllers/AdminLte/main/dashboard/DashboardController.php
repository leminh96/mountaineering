<?php
namespace App\Http\Controllers\AdminLte\main\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts;
use App\Models\accounts\Accounts as AccountsAccounts;
use App\Models\accounts\Like_Articles;
use App\Models\accounts\Like_Groups;
use App\Models\accounts\Like_Mountains;
use App\Models\accounts\Rate_Groups;
use App\Models\accounts\Rate_Mountains;
use App\Models\articles\Articles;
use App\Models\emails\Emails;
use App\Models\groups\Groups;
use App\Models\location\City;
use App\Models\location\Country;
use App\Models\mountains\Mountains;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data=[
            'users'=>AccountsAccounts::count(),
            'mountains'=>Mountains::count(),
            'mountains0'=>Mountains::where('deactivated',0)->count(),
            'rates_mountains'=>Rate_Mountains::count(),
            'rm_avg'=>Rate_Mountains::avg('rate_score'),
            'countries'=>Country::count(),
            'cities'=>City::count(),
            'blogs'=>Articles::count(),
            'blogs0'=>Articles::where('deactivated',0)->count(),
            'groups'=>Groups::count(),
            'groups0'=>Groups::where('deactivated',0)->count(),
            'rates_groups'=>Rate_Groups::count(),
            'rg_avg'=>Rate_Groups::avg('rate_score'),
            'likes_mountains'=>Like_Mountains::count(),
            'likes_groups'=>Like_Groups::count(),
            'likes_blogs'=>Like_Articles::count(),
            'articlesList' => Articles::where('deactivated', 0)->orderby('id', 'DESC')->take(10)->get(),
            'accountsList' => AccountsAccounts::where('deactivated', 0)->orderby('id', 'DESC')->take(16)->get(),
            'notify'=>Emails::where('status',0)->orderBy('id', 'DESC')->count(),
            'emailNotify'=>Emails::where('status',0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
        ];
        $data['likes_all'] = $data['likes_mountains'] + $data['likes_groups'] + $data['likes_blogs'];

        return view('AdminLte/main-page/dashboard/dashboard')->with($data);
    }

    public function messMaker($icon, $mess, $text){
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }





}


