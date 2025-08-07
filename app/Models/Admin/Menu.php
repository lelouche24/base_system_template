<?php

namespace App\Models\Admin;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
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


    protected $table = 'menus';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = true;

    protected $attributes = [

        'slug' => '',
        'menu_id' => '',
        'menuName_create' => '',
        'menuRoute_create' => '',
        'icon' => '',
        'is_menu_create' => false,
        'is_dropdown_create' => false,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];

    public function submenu() {
    	return $this->hasMany(Submenu::class,'menu_id','menu_id')->orderBy('sort','asc');
   	}
}
