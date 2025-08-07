<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */

    protected $user;

    public function __construct(UserService $user){

        $this->user = $user;
    }

    public function index(Request $request)
    {
        return $this->user->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->user->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        return $this->user->show($slug);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->user->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->user->destroy($slug);
    }

    public function activate($slug, $status)
    {
        return $this->user->activate($slug, $status);
    }

    public function change_password(Request $request)
    {
        return $this->user->change_password($request);
    }

    public function update_access(Request $request)
    {
        return $this->user->update_access($request);
    }
}
