<?php
namespace App\Models\mountains;

use Illuminate\Database\Eloquent\Model;

class Mountains extends Model{
protected $table='mountains';
protected $primarykey='id';

public $timestamps=false;

protected $fillable=[
    'name' ,
    'photo_main',
    'description' ,
    'history',
    'guides',
    'api',
    'location',
    'sheltering',
    'dangers', 
    'deactivated',
    'country_id' 
    ];

}


?>