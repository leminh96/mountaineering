<?php
namespace App\Models\groups;

use Illuminate\Database\Eloquent\Model;

class Group_mountain extends Model{
protected $table='grouporgclub_mountain';
protected $primaryKey = ['group_id','mountain_id' ];

public $timestamps=false;
public $incrementing = false;
protected $fillable=[
    'group_id',
    'mountain_id' 
    ];

}


?>