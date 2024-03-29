<?php
namespace App\Models\accounts;

use Illuminate\Database\Eloquent\Model;

class Like_Groups extends Model{
protected $table='likes_groups';
protected $primarykey=['user_id','group_id' ];
public $incrementing = false;

public $timestamps=false;

protected $fillable=[
    'user_id' ,
    'group_id', 
    'created' 
    ];

}


?>