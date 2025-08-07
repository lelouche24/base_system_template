<?php


namespace App\Composer;

use App\Models\Menu;
use App\Models\Admin\UserSubmenu;
use Illuminate\Support\Facades\Auth;

class TreeComposer
{
    public function compose ($view){



        $tree = [];

        $guard = session('auth_guard', 'web');
        $user = Auth::guard($guard)->user();


        $user_submenus = UserSubmenu::with(['submenu.menu'])
            ->where('user_id', $user->user_id)
            ->whereHas('submenu', function ($query) {
                $query->where('is_nav', '=', 1);
            })
            ->get();

        foreach ($user_submenus as $user_submenu) {
            $tree[$user_submenu->submenu->menu->menuCategory_create][$user_submenu->submenu->menu->menu_id]['menu_obj'] = $user_submenu->submenu->menu;
            $tree[$user_submenu->submenu->menu->menuCategory_create][$user_submenu->submenu->menu->menu_id]['submenus'][$user_submenu->submenu->sort . $user_submenu->submenu_id] = $user_submenu->submenu;
        }

        // dd($tree);

        $view->with(['tree' => $tree]);
    }
}