<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SubmenuService;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{

    protected $submenu;

    public function __construct(SubmenuService $submenu){

        $this->submenu = $submenu;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->submenu->index($request);
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
        return $this->submenu->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($menu_id)
    {
        return $this->submenu->show($menu_id);
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
        return $this->submenu->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->submenu->destroy($slug);
    }
}
