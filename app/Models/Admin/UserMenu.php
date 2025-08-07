<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    use HasFactory;

    
    protected $table = 'user_menus';

    public $timestamps = false;

	/** RELATIONSHIPS **/
	public function user() {
      return $this->belongsTo(AdminModel::class,'user_id','user_id');
    }

        public function menu(){
        return $this->belongsTo(Menu::class,'menu_id','menu_id');
    }
}
