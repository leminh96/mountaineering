<?php

namespace App\Http\Controllers\AdminLte\main\contact;

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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmailsController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        

        $data = [
            'newEmails' => Emails::where('status', 0)->orderBy('id', 'DESC')->get(),
            'countEs' => Emails::whereDate('created', $today)->count(),
            'oldEmails' => Emails::where('status', 1)->orderBy('id', 'DESC')->get(),
            'notify'=>Emails::where('status',0)->orderBy('id', 'DESC')->count(),
            'emailNotify'=>Emails::where('status',0)->orderBy('id', 'DESC')->take(3)->get(),
            'addCountryList' => Country::get(),
            'validateCityList' => City::get(),
            'validateCountryList' => Country::get()
            
        ];

        return view('AdminLte/main-page/contact/emails')->with($data);
    }

    public function messMaker($icon, $mess, $text)
    {
        session()->put('icon', $icon);
        session()->put('mess', $mess);
        session()->put('text', $text);
    }
    public function Read(Request $request)
    {
        $button = $request->get('button');
        if ($button != null) {
            if ($button == 'mask-as-read') {
                $data = [
                    'status' => 1
                ];
                Emails::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Mask email as Read Successfully !', 'Email id "' . $request->get('id') . '" has been mask as Read ');
            } else if ($button == 'mask-as-unread') {
                $data = [
                    'status' => 0
                ];
                Emails::where('id', $request->get('id'))->update($data);
                $this->messMaker('success', 'Mask email as Unread Successfully !', 'Email id "' . $request->get('id') . '" has been mask as Unread ');
            }
        }

        $currentUrl = $request->get('currentUrl');
        if ($currentUrl != null) {

            return redirect($currentUrl);
        }


        return redirect('/admin/contact/emails');
    }
}
