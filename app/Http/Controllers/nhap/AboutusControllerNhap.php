<?php
namespace App\Http\Controllers\nhap;
use App\Http\Controllers\Controller;
use App\Models\Category;

    class AboutusControllerNhap extends Controller{
        public function index(){
           
            return view('/nhap/aboutus/index');
        }
       
    } 
?>
