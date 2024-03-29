<?php
namespace App\Models\articles;

use Illuminate\Database\Eloquent\Model;

class Article_category extends Model{
protected $table='article_category';
protected $primaryKey = ['category_id','article_id' ];

public $timestamps=false;
public $incrementing = false;
protected $fillable=[
    'category_id','article_id'
    ];

}


?>