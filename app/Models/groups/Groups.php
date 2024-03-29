<?php
namespace App\Models\groups;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model{
protected $table='grouporgclub';
protected $primarykey='id';

public $timestamps=false;

protected $fillable=[
    'name' ,
    'leader_name',
    'description' ,
    'contact',
    'photo',
    'api',
    'deactivated' 
    ];

}


?>