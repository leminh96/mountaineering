<?php
namespace App\Http\Controllers\nhap;
use App\Http\Controllers\Controller;
use App\Models\articles\Categories;

    class CategoryControllerNhap extends Controller{
        public function index(){
            $data = [
                'category'=>Categories::get()
            ];
            return view('/nhap/layout/user')->with($data);
        }
       
    } 
?>
