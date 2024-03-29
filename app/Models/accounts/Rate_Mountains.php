<?php
namespace App\Models\accounts;

use Illuminate\Database\Eloquent\Model;

class Rate_Mountains extends Model{
protected $table='rates_mountains';
protected $primarykey=['user_id','mountain_id' ];
public $incrementing = false;

public $timestamps=false;

protected $fillable=[
    'user_id' ,
    'mountain_id',
    'rate_score', 
    'created' 
    ];

}


?>