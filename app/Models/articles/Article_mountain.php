<?php
namespace App\Models\articles;

use Illuminate\Database\Eloquent\Model;

class Article_mountain extends Model{
protected $table='article_mountain';
protected $primaryKey = ['mountain_id','article_id' ];

public $timestamps=false;
public $incrementing = false;
protected $fillable=[
    'mountain_id','article_id'
    ];

}


?>