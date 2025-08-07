<?php

namespace App\Services;

use App\Helpers\Helper;
use Illuminate\Support\Str;
use App\Helpers\BaseService;
use App\Models\Admin\Submenu;
use App\Interfaces\MenuInterface;
use App\Models\Admin\UserSubmenu;
use Illuminate\Support\Facades\DB;
use App\Interfaces\SubmenuInterface;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class SubmenuService extends BaseService{
        protected $submenu;
        protected $auth;

        public function __construct(Submenu $submenu, AuthFactory $auth)
        {
            $this->submenu = $submenu;
            $this->auth = $auth;
        }

        public function index($request){
            if ($request->has('draw')) {
                        $submenus = $this->submenu
                            ->where('menu_id','=',$request->menu_id)
                            ->withCount(['usersWithAccess'])
                            ->newQuery();
                        return DataTables::of($submenus)
                            ->addColumn('action',function($data){
                                return view('menu.dtActionsSubmenu')->with([
                                    'data' => $data,
                                ]);
                            })
                            ->editColumn('is_nav',function($data){
                                return $data->is_nav == 1 ? '<i class="fa fa-check"></i>' : '';
                            })
                            ->addColumn('users_with_access_count',function($data){
                                return $data->public == 1 ? 'All authenticated' : $data->users_with_access_count;
                            })
                            ->escapeColumns([])
                            ->setRowId('slug')
                            ->toJson();
                    }
        }

        public function show($menu_id){
            return view('menu.modals.submenuMdl', compact('menu_id'));
        }

        public function destroy($slug){
            try {
                DB::beginTransaction();

                $submenu = $this->submenu->where('slug', $slug)->first();

                if($submenu->delete()){
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

        public function store($request){

            try {
                DB::beginTransaction();

                $formData = $request->formData;

                $submenu = $this->submenu->newInstance();
                $submenu->slug = Str::random(8);
                $submenu->submenu_id = strtoupper(Str::random(6));
                $submenu->name = $formData['name'];
                $submenu->route = $formData['route'];
                $submenu->nav_name = $formData['nav_name'];
                $submenu->is_nav = $formData['is_nav'] ?? null;
                $submenu->menu_id = $request->menu_id;

                if ($submenu->save()) {
                    DB::commit();
                    return 1;
                }

                DB::rollBack();
                abort(503, 'Error saving data.');

            } catch (\Exception $e) {
                DB::rollBack();
                abort(500, 'Unexpected server error. Please try again later.');
            }

        }

        public function update($request){

            try {
                DB::beginTransaction();

                $formData = $request->formData;

                $submenu = $this->submenu->where('slug', $formData['slug'])->firstOrFail();
                $submenu->name = $formData['name'];
                $submenu->route = $formData['route'];
                $submenu->nav_name = $formData['nav_name'];
                $submenu->is_nav = $formData['is_nav'] ?? null;

                if ($submenu->save()) {
                    DB::commit();
                    return 1;
                }

                DB::rollBack();
                abort(503, 'Error updating data.');

            } catch (\Exception $e) {
                DB::rollBack();
                abort(500, 'Unexpected server error. Please try again later.');
            }
        }

        public function isExist($rt = null)
        {
            $routeName = $rt ?? Route::currentRouteName();
            $userId = $this->auth->user()->user_id;

            $submenu = $this->submenu->where('route', $routeName)->first();

            if (!$submenu) {
                abort(404, 'Route does not exist');
            }

            $userSubmenu = UserSubmenu::where('submenu_id', $submenu->submenu_id)
                ->where('user_id', $userId)
                ->first();

            if (!$userSubmenu) {
                abort(403, 'This action is unauthorized');
            }

            return true;
        }

}