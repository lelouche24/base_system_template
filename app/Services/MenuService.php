<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Admin\Menu;
use Illuminate\Support\Str;
use App\Helpers\BaseService;
use App\Models\Admin\Submenu;
use App\Interfaces\MenuInterface;
use Illuminate\Support\Facades\DB;
use App\Interfaces\SubmenuInterface;
use Yajra\DataTables\Facades\DataTables;

class MenuService extends BaseService{
    protected $menu;

    public function __construct(Menu $menu){
        $this->menu = $menu;
    }

    public function index($request){
        if($request->has('draw')){
            $menus = $this->menu
                ->with(['submenu'])
                ->newQuery();

            return DataTables::of($menus)
                ->addColumn('action',function($data){
                    return view('menu.dtActions')->with([
                        'data' => $data,
                    ]);
                })
                ->addColumn('submenus',function($data){
                    return view('menu.dtSubmenus')->with([
                        'data' => $data,
                    ]);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }

        return view('menu.index');
    }

    public function store($request){
        $trimmedRouteName = Str::of($request->menuRoute_create)->rtrim('.*');
        $menu = new Menu;
        $menu->slug = Str::random(15);
        $menu->menu_id = strtoupper(Str::random(6));
        $menu->menuName_create = $request->menuName_create;
        $menu->menuRoute_create = $trimmedRouteName;
        $menu->menuCategory_create = $request->menuCategory_create;
        $menu->icon = $request->filled('icon') ? $request->icon : 'fas fa-file-alt';
        $menu->is_dropdown_create = $request->is_dropdown_create ?? null;
        $menu->is_menu_create = $request->is_menu_create ?? null;
        $menu->menuPortal_create = $request->menuPortal_create  ?? null;

        $submenusToInsert = [];
        $knownSubmenus = Helper::knownSubmenus();
        if(count($request->submenus) > 0){
            foreach($request->submenus as $submenu){
                $submenusToInsert[] = [
                    'slug' => Str::random(),
                    'submenu_id' => strtoupper(Str::random(6)),
                    'menu_id' => $menu->menu_id,
                    'name' => $menu->menuName_create.' '.($knownSubmenus[$submenu] ?? '') ,
                    'route' => $trimmedRouteName.'.'.$submenu,
                ];
            }
        }
        if($menu->save()){
            if(count($submenusToInsert) > 0){
                Submenu::query()->insert($submenusToInsert);
            }
            return 1;
        }
        abort(503,'Error saving data.');
    }

    public function destroy($slug){
        try {
            DB::beginTransaction();

            $menu = $this->menu->where('slug', $slug)->first();

            if($menu->delete()){
                $menu->submenu()->delete();
                DB::commit();
                return 1;
            }

            DB::rollBack();
            abort(503, 'Error destroying data.');


        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

public function update($request)
{
    $menu = $this->menu->where('slug', $request->slug)->first();
    if (!$menu) {
        abort(404, 'Menu not found.');
    }

    try {
        DB::beginTransaction();

        $trimmedRouteName = Str::of($request->menuRoute_create)->rtrim('.*');
        $menu->menuName_create = $request->menuName_create;
        $menu->menuRoute_create = $trimmedRouteName;
        $menu->menuCategory_create = $request->menuCategory_create;
        $menu->icon = $request->filled('icon') ? $request->icon : 'fas fa-file-alt';
        $menu->is_dropdown_create = $request->is_dropdown_create ?? null;
        $menu->is_menu_create = $request->is_menu_create ?? null;
        $menu->menuPortal_create = $request->menuPortal_create ?? null;

        if ($menu->save()) {
            DB::commit();
            return 2;
        }

        DB::rollBack();
        abort(503, 'Error updating data.');

    } catch (\Exception $e) {
        DB::rollBack();
        abort(500, 'Update failed: ' . $e->getMessage());
    }
}

}