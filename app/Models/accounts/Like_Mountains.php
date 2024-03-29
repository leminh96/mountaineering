<?php
namespace App\Models\accounts;

use Illuminate\Database\Eloquent\Model;

class Like_Mountains extends Model{
protected $table='likes_mountains';
protected $primarykey=['user_id','mountain_id' ];
public $incrementing = false;

public $timestamps=false;

protected $fillable=[
    'user_id' ,
    'mountain_id', 
    'created' 
    ];

}


?>