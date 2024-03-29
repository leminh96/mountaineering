<?php
namespace App\Models\emails;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model{
protected $table='emails';
protected $primarykey='id';

public $timestamps=false;

protected $fillable=[
    'name' ,
    'email',
    'message' ,
    'created',
    'status',
    ];
    public function getTimeAgoAttribute()
    {
        return Carbon::parse($this->attributes['created'])->diffForHumans();
    }
}


?>