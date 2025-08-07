<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Helper;
use App\Helpers\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LastActivity extends BaseService
{
    protected $auth;
    protected $session;

    public function __construct(){
        $this->auth = auth();
        $this->session = session();
        $this->carbon = App::make(Carbon::class);
    }

    public function handle(Request $request, Closure $next): Response
    {
        $guard = session('auth_guard', 'web');

        if ($this->auth->guard($guard)->check()) {
            $user = $this->auth->guard($guard)->user();

            // Use carbon instance from BaseService
            $now = $this->carbon->now();
            $threshold = $now->copy()->subMinutes(5);

            if ($user->last_activity < $threshold) {
                $user->last_activity = $now;
                $user->last_login_ip = $request->ip();
                $user->timestamps = false;
                $device = Helper::deviceInfo();
                $user->last_activity_machine = $device->platform . ' | ' . $device->browser;
                $user->save();
            }
        }

        return $next($request);
    }
}