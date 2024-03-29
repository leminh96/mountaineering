<?php
namespace App\Models\articles;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model{
protected $table='category';
protected $primarykey='id';

public $timestamps=false;

protected $fillable=[
    'name' 
    ];

}


?>