<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubmenu extends Model
{
    use HasFactory;

    
    protected $table = 'user_submenus';

    public $timestamps = false;


    public function user() {
        return $this->belongsTo(AdminModel::class,'user_id','user_id');
    }

    public function submenu(){
        return $this->belongsTo(Submenu::class,'submenu_id','submenu_id');
    }
}
