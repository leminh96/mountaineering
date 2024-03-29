<?php
namespace App\Models\articles;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model{
protected $table='article';
protected $primarykey='id';

public $timestamps=false;

protected $fillable=[
    'name' ,
    'photo',
    'description' ,
    'created',
    'category_id',
    'deactivated'
    ];

}


?>