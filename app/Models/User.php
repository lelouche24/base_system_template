<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\UserMenu;
use App\Models\Admin\UserSubmenu;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public static function boot()
     {
         parent::boot();
         static::creating(function ($logs) {
             $user = auth()->guard(session('auth_guard', 'web'))->user();
             $logs->user_created = $user?->user_id ?? 'system';
             $logs->ip_created = request()->ip();
         });

         static::updating(function ($logs) {
             $user = auth()->guard(session('auth_guard', 'web'))->user();
             if (!empty($user?->user_id)) {
                 $logs->user_updated = $user->user_id;
             }
             $logs->ip_updated = request()->ip();
         });
     }

    protected $fillable = [
        'slug',
        'lname',
        'fname',
        'minitial',
        'fullname',
        'gender',
        'username',
        'password',
        's_password',
        'role_type',
        'avatar',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['fullname','username', 'is_online', 'is_active'];

    public $timestamps = true;

    protected $hidden = [
        'password',
        's_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_verified_at' => 'datetime',
    ];

    public function userMenu() {
        return $this->hasMany(UserMenu::class,'user_id','user_id');
    }

    public function userSubmenu() {
        return $this->hasMany(UserSubmenu::class,'user_id','user_id');
    }
}
