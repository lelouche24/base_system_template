<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $menu;

    public function __construct(MenuService $menu){

        $this->menu = $menu;

    }
    public function index(Request $request)
    {
        return $this->menu->index($request);
            // return view('menu.index');
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
        return $this->menu->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        return $this->menu->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->menu->destroy($slug);
    }
}
