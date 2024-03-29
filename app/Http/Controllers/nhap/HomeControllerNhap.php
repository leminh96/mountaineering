<?php
namespace App\Http\Controllers\nhap;
use App\Http\Controllers\Controller;
use App\Models\articles\Articles;
use App\Models\articles\Categories;

    class HomeControllerNhap extends Controller{
        public function index(){
            $data = [
                'category'=>Categories::get(),
                'article'=>Articles::where('deactivated',0)->get(),
                'featuredNews' =>Articles::orderBy('id', 'desc')->first(),
                'otherNews' => Articles::orderBy('id', 'desc')->skip(1)->take(3)->get()
            ];
            return view('nhap/home/index')->with($data);
        }
       
    } 
?>
