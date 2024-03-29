<?php
namespace App\Http\Controllers\nhap;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\mountains\Mountains;

    class MountainControllerNhap extends Controller{
        public function index(){
            $data = [
                'mountains'=>Mountains::where('deactivated',0)->paginate(9)
            ];
            return view('nhap/mountain/index')->with($data);
        }
    } 
?>
