<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SubmenuService;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRouteExist
{
    protected $submenuService;



    public function __construct(SubmenuService $submenuService){

        $this->submenuService = $submenuService;

    }

    public function handle(Request $request, Closure $next): Response
    {
        $this->submenuService->isExist();

        return $next($request);
    }

}