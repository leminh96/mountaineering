<?php
namespace App\Models\resetpassword;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model{
protected $table='password_reset_tokens';
protected $primarykey='email';

public $timestamps=false;

protected $fillable=[
    'email',
    'token' ,
    'created_at'
    ];
    
}


?>