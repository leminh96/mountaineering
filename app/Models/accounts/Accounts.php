<?php
namespace App\Models\accounts;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\accounts\Like_Mountains;
use App\Models\accounts\Like_Articles;
use App\Models\accounts\Like_Groups;
use App\Models\accounts\Rate_Mountains;
use App\Models\accounts\Rate_Groups;
use App\Models\accounts\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accounts extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // Tên bảng trong database
    protected $primaryKey = 'id'; // Khóa chính của bảng

    public $timestamps = false; // Tắt tính năng timestamps nếu bạn không sử dụng

    protected $fillable = [
        'username',
        'fullname',
        'photo',
        'gender',
        'password',
        'email',
        'dob',
        'phone',
        'role_id',
        'deactivated',
        'created',
        'deactivated_date'
    ];

    protected $hidden = [
        'password', // Ẩn mật khẩu khi model được serialize
    ];

    public function rate_groups(): HasMany
    {
        return $this->hasMany(Rate_Groups::class, 'user_id', 'id');
    }

    public function rate_mountains(): HasMany
    {
        return $this->hasMany(Rate_Mountains::class, 'user_id', 'id');
    }
    public function like_mountains(): HasMany
    {
        return $this->hasMany(Like_Mountains::class, 'user_id', 'id');
    }
    public function like_groups(): HasMany
    {
        return $this->hasMany(Like_Groups::class, 'user_id', 'id');
    }
    public function like_article(): HasMany
    {
        return $this->hasMany(Like_Articles::class, 'user_id', 'id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
    
}