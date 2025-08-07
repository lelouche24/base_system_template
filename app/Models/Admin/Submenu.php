<?php

namespace App\Models\Admin;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submenu extends Model
{
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

    use Sortable, HasFactory;

    protected $table = 'submenus';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['name', 'route', 'is_nav'];

    public $timestamps = true;

    public function menu() {
    	return $this->belongsTo(Menu::class,'menu_id','menu_id');
   	}

    public function usersWithAccess()
    {
        return $this->hasMany(UserSubmenu::class,'submenu_id','submenu_id');
    }
}
