<?php

namespace App\Services;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\Admin\Menu;
use Illuminate\Support\Str;
use App\Helpers\BaseService;
use App\Models\Admin\UserMenu;
use App\Models\Admin\UserSubmenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class UserService extends BaseService{

    protected $user;

    public function __construct(User $user){

        parent::__construct();
        $this->user = $user;
    }

    public function index($request){
        if($request->has('draw')){
            $user = $this->user->newQuery();
            return DataTables::of($user)
                ->editColumn('last_activity',function ($data){
                    return view('usercontrol.action.dtIsOnline')->with([
                        'data' => $data,
                    ]);
                })
                ->addColumn('is_activated',function($data){
                    return view('usercontrol.action.dtIsActive')->with([
                        'data' => $data,
                    ]);
                })
                ->addColumn('action', function ($data) {
                    return view('usercontrol.action.dtUserActions')->with([
                        'data' => $data,
                    ]);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('usercontrol.usermanagement');
    }

    public function store($request){
    try {
            DB::beginTransaction();

            $user = $this->user->newInstance();
            $user->slug = Str::random(8);
            $user->user_id = rand(1000000, 9999999);
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->lname = strtoupper(Helper::regexSpecChar($request->lname));
            $user->fname = strtoupper(Helper::regexSpecChar($request->fname));
            $user->minitial = strtoupper(Helper::regexSpecChar($request->minitial));
            $user->fullname = $user->fname . ' ' . $user->minitial . ' ' . $user->lname;

            if ($user->save()) {
                DB::commit();
                return 1;
            }

            DB::rollBack();
            abort(503, 'Error saving data.');

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
    public function update($request){
    try {
            DB::beginTransaction();

            $user = $this->user->where('slug', $request->slug)->firstOrFail();

            $user->username = $request->username;
            $user->lname = strtoupper(Helper::regexSpecChar($request->lname));
            $user->fname = strtoupper(Helper::regexSpecChar($request->fname));
            $user->minitial = strtoupper(Helper::regexSpecChar($request->minitial));
            $user->fullname = $user->fname . ' ' . $user->minitial . ' ' . $user->lname;

            if ($user->save()) {
                DB::commit();
                return 2;
            }

            DB::rollBack();
            abort(503, 'Error updating data.');

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($slug){
        try {
            DB::beginTransaction();

            $user = $this->user->where('slug', $slug)->first();

            if($user->delete()){
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

    public function activate($slug, $status){
        try {
            DB::beginTransaction();

            $user = $this->user->where('slug', $slug)->firstOrFail();
            $user->is_activated = $status == 0 ? 1 : 0;

            if ($user->update()) {
                DB::commit();
                return 1;
            }

            DB::rollBack();
            abort(503, 'Error updating user status.');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function change_password($request){
        try {
            DB::beginTransaction();

            $user = $this->user->where('slug', $request->slug)->firstOrFail();

            if ($request->password !== $request->password_confirmation) {
                abort(422, 'Passwords do not match!');
            }

            $user->password = Hash::make($request->password);
            $user->s_password = $request->password;

            if ($user->update()) {
                DB::commit();
                return 1;
            }

            DB::rollBack();
            abort(503, 'Error changing password.');

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($slug){
    $user = $this->user->with('userSubmenu')
            ->where('slug', $slug)
            ->firstOrFail();

        $menus = Menu::with('submenu')
            ->orderBy('menuName_create', 'asc')
            ->get();

        $user_submenus_arr = $user->userSubmenu
            ->pluck('submenu_id')
            ->mapWithKeys(fn($id) => [$id => 1])
            ->all();

        return view('usercontrol.modal.access', [
            'user' => $user,
            'menus' => $menus,
            'user_submenus_arr' => $user_submenus_arr,
            'portals' => $menus->sortBy('menuPortal_create')->groupBy('menuPortal_create'),
        ]);
    }

    public function update_access($request){
        $user = $this->user->where('slug', $request->slug)
            ->with(['userMenu', 'userSubmenu'])
            ->first();

        if (empty($user)) {
            abort(404, 'User not found.');
        }

        $user->userMenu()->delete();
        $user->userSubmenu()->delete();

        $user_id = $user->user_id;

        if (!empty($request->submenus)) {
            $data = [];
            $submenu_data = [];
            foreach ($request->submenus as $menu_id => $submenus) {
                $data[] = [
                    'menu_id' => $menu_id,
                    'user_id' => $user_id,
                ];

                foreach ($submenus as $submenu_id) {
                    $submenu_data[] = [
                        'user_id' => $user_id,
                        'submenu_id' => $submenu_id,
                    ];
                }
            }

            if (!empty($data) && !UserMenu::insert($data)) {
                abort(500, 'Failed to update user menus.');
            }

            if (!empty($submenu_data) && !UserSubmenu::insert($submenu_data)) {
                abort(500, 'Failed to update user submenus.');
            }
        }

        return 2;
    }
}