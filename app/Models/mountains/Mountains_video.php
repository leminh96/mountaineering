<?php
namespace App\Models\mountains;

use Illuminate\Database\Eloquent\Model;

class Mountains_video extends Model{
protected $table='mountain_video';
protected $primaryKey = 'id';

public $timestamps=false;

protected $fillable=[
    'mountain_id' ,
    'name'
    ];

}


?>