<?php
namespace App\Models\location;

use Illuminate\Database\Eloquent\Model;

class Country_mountain extends Model{
protected $table='country_mountain';
protected $primaryKey = ['country_id','mountain_id' ];

public $timestamps=false;
public $incrementing = false;
protected $fillable=[
    'country_id',
    'mountain_id' 
    ];

}


?>