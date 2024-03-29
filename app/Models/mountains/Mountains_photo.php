<?php
namespace App\Models\mountains;

use Illuminate\Database\Eloquent\Model;

class Mountains_photo extends Model{
protected $table='mountain_photo';
protected $primaryKey = 'id';

public $timestamps=false;

protected $fillable=[
    'name',
    'mountain_id' 
    ];

}


?>