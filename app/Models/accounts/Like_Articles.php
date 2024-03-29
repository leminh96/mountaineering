<?php
namespace App\Models\accounts;

use Illuminate\Database\Eloquent\Model;

class Like_Articles extends Model{
protected $table='likes_articles';
protected $primarykey=['user_id','article_id'];
public $incrementing = false;
public $timestamps=false;

protected $fillable=[
    'user_id' ,
    'article_id', 
    'created' 
    ];

}


?>