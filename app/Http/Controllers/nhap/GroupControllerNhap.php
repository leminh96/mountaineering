<?php
namespace App\Http\Controllers\nhap;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\groups\Groups;

    class GroupControllerNhap extends Controller{
        public function index(){
            $data = [
                'groups'=>Groups::where('deactivated',0)->get()
            ];
            return view('/nhap/organization/index')->with($data);
        }
       
    } 
?>
