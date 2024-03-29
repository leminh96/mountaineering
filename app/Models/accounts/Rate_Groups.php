<?php
namespace App\Models\accounts;

use Illuminate\Database\Eloquent\Model;
use App\Models\accounts\Accounts;

class Rate_Groups extends Model{
protected $table='rates_groups';
protected $primarykey=['user_id','group_id' ];
public $incrementing = false;

public $timestamps=false;

protected $fillable=[
    'user_id' ,
    'group_id',
    'rate_score', 
    'created' 
    ];


    public function user()
{
    return $this->belongsTo(Accounts::class)->onDelete('cascade');
}

}




?>