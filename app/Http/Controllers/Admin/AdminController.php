<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use Auth;
use Validator;
use Session;
use Hash;
use DB;
use DataTables;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function dashboard(){
        Session::put('page','dashboard');

        return view('dashboard');
    }

    // public function login(Request $request){

    //     if($request->isMethod('post')){
    //         $data = $request->all();

    //         $rules = [
    //             'username' => 'required|max:255',
    //             'password' => 'required|max:30',
    //         ];

    //         $customMessage = [
    //             'username.required' => "Username is required",
    //             'password.required' => "Password is required",
    //         ];
    //         $this->validate($request, $rules, $customMessage);

    //         if(Auth::guard('admin')->attempt(['username'=>$data['username'],'password'=>$data['password']]) && Auth::guard('admin')->user()->status=="1"){

    //             return redirect('admin/dashboard');
    //         }

    //         elseif(Auth::guard('admin')->attempt(['username'=>$data['username'],'password'=>$data['password']]) && Auth::guard('admin')->user()->status=="0"){

    //             return redirect()->back()->with("error_message","Account Disabled");
    //         }
    //         else{
    //             return redirect()->back()->with("error_message","Invalid Username or Password!");
    //         }
    //     }

    //    return view('login.login');
    // }

    // public function logout(){
    //     Auth::guard('admin')->logout();
    //     return redirect('admin/login');
    // }

    // protected function generateUniqueSlug($departmentCode){

    //     $baseSlug = Str::slug($departmentCode); // Laravel function to create a basic slug

    //     $latestSlug = AdminModel::where('slug', 'like', $baseSlug . '%')
    //         ->orderBy('slug', 'desc')
    //         ->first();

    //     if (!$latestSlug) {
    //         // No existing slugs with this base, start with 0000
    //         return $baseSlug . '-0000';
    //     }

    //     // Extract the current number and increment
    //     $lastNumber = intval(substr($latestSlug->slug, -4));
    //     $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

    //     return $baseSlug . '-' . $newNumber;
    // }

    // public function usercontrol(){

    //     Session::put('page','usercontrol');

    //     if(request()->ajax()){
    //         $data = AdminModel::orderBy('id')->get();

    //         \Log::info($data);

    //         return DataTables::of($data)
    //         ->addColumn('action','usercontrol\action\usermanagement_action')
    //         ->rawColumns(['action'])
    //         ->addIndexColumn()
    //         ->make(true);

    //         return Response()->json($data);
    //     }

    //     return view('usercontrol.usermanagement');
    // }

    // public function adduserinfo(Request $request){
    //     // Validate request data
    //     $request->validate([
    //         'admin_username' => 'required|unique:admin,username',
    //         'admin_firstname' => 'required',
    //         'admin_lastname' => 'required',
    //         'admin_usertype' => 'required',
    //         // Add other validation rules for the remaining fields...
    //     ]);

    //     $dataID = $request->admin_id;

    //     $userData = [
    //         'username' => $request->admin_username,
    //         'slug' => Str::upper($this->generateUniqueSlug($request->admin_department)),
    //         'firstname' => Str::upper($request->admin_firstname),
    //         'middlename' => Str::upper($request->admin_middlename),
    //         'lastname' => Str::upper($request->admin_lastname),
    //         'fullname' => Str::upper("{$request->admin_lastname}, {$request->admin_firstname} {$request->admin_middlename[0]}."),
    //         'status' => 0,
    //         'user_type' => $request->admin_usertype,
    //         'user_roles' => 1,
    //         'department' => $request->admin_department,
    //         'position' => $request->admin_position,
    //     ];

    //     if ($request->filled('admin_password')) {
    //         // Update password only if provided
    //         $userData['password'] = bcrypt($request->admin_password);
    //     }

    //     $adduser = AdminModel::updateOrCreate(['id' => $dataID], $userData);

    //     return response()->json(['message' => 'User information updated successfully', 'data' => $adduser]);
    // }

    // public function deleteuserinfo(Request $request){

    //     $where = array('id' =>$request->id);
    //     $adminuserRecord = AdminModel::where($where)->delete();
    //     return Response()->json($adminuserRecord);
    // }

    // public function edituserinfo(Request $request){

    //     $where = array('id' =>$request->id);
    //     $adminuserRecord = AdminModel::where($where)->first();
    //     return Response()->json($adminuserRecord);
    // }

    // public function updateuserinfo(Request $request){

    //     $dataID = $request->admin_edit_id;

    //    if($request->filled('admin_edit_password')){

    //     $adduser =  AdminModel::updateOrCreate(
    //             [
    //             'id'=>$dataID
    //             ],
    //             [
    //             'password'=>bcrypt($request->admin_edit_password),
    //             'firstname' => Str::upper($request->admin_edit_firstname),
    //             'middlename' => Str::upper($request->admin_edit_middlename),
    //             'lastname' => Str::upper($request->admin_edit_lastname),
    //             'fullname' => Str::upper("{$request->admin_edit_lastname}, {$request->admin_edit_firstname} {$request->admin_edit_middlename[0]}."),
    //             'user_type'=>$request->admin_edit_usertype,
    //             'position'=>$request->admin_edit_position,
    //             'department'=>$request->admin_edit_department,
    //             ]);
    //     }else{

    //         $adduser =  AdminModel::updateOrCreate(
    //             [
    //             'id'=>$dataID
    //             ],
    //             [
    //             'password'=>bcrypt(123456),
    //             'firstname' => Str::upper($request->admin_edit_firstname),
    //             'middlename' => Str::upper($request->admin_edit_middlename),
    //             'lastname' => Str::upper($request->admin_edit_lastname),
    //             'fullname' => Str::upper("{$request->admin_edit_lastname}, {$request->admin_edit_firstname} {$request->admin_edit_middlename[0]}."),
    //             'user_type'=>$request->admin_edit_usertype,
    //             'position'=>$request->admin_edit_position,
    //             'department'=>$request->admin_edit_department,
    //             ]);
    //     }

    //         return Response()->json($adduser);
    // }

    // public function edituserStatusinfo(Request $request){

    //     $dataID = $request->admin_statusID;

    //     $adduser =  AdminModel::updateOrCreate(
    //         [
    //         'id'=>$dataID
    //         ],
    //         [
    //         'status'=>$request->admin_status,
    //         'user_roles'=>$request->admin_roles,
    //         ]);

    //         return Response()->json($adduser);
    // }

    // public function registeruserinfo(Request $request){

    //     \Log::info('Received registration data: ' . json_encode($request->all()));

    //     // Validate request data
    //     $request->validate([
    //         'registration_username' => 'required|unique:admin,username',
    //         'registration_firstname' => 'required',
    //         'registration_lastname' => 'required',
    //     ]);

    //     $dataID = $request->registration_id;

    //     $userData = [
    //         'username' => $request->registration_username,
    //         'slug' => Str::upper($this->generateUniqueSlug($request->registration_department)),
    //         'firstname' => Str::upper($request->registration_firstname),
    //         'middlename' => Str::upper($request->registration_middlename),
    //         'lastname' => Str::upper($request->registration_lastname),
    //         'fullname' => Str::upper("{$request->registration_lastname}, {$request->registration_firstname} {$request->registration_middlename[0]}."),
    //         'user_type' => 'user',
    //         'user_roles' => '2',
    //         'status' => 0,
    //         'department' => $request->registration_department,
    //         'position' => $request->registration_position,
    //     ];

    //     if ($request->filled('registration_password')) {
    //         // Update password only if provided
    //         $userData['password'] = bcrypt($request->registration_password);
    //     }

    //     $adduser = AdminModel::updateOrCreate(['id' => $dataID], $userData);

    //     \Log::info('User information updated successfully');

    //     return response()->json(['message' => 'User information updated successfully', 'data' => $adduser]);
    // }
}
