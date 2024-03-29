<?php
namespace App\Models\location;

use Illuminate\Database\Eloquent\Model;

class City extends Model{
protected $table='cities';
protected $primarykey='id';

public $timestamps=false;

protected $fillable=[
    'name',
    'country_id'
    ];

}


?>