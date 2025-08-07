<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Closure; 
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{

    protected $auth;
    protected $session;

    public function __construct(){
        $this->auth = auth();
        $this->session = session();
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Check only the 'web' guard
        if ($this->auth->guard('web')->check()) {
            $user = $this->auth->guard('web')->user();

            if (!$user->is_activated) {
                $this->auth->guard('web')->logout();
                $this->session->flush();
                $this->session->flash('CHECK_NOT_ACTIVE', 'Your account has been deactivated! It may be possible that you were marked as INACTIVE employee.');
                return redirect('/');
            }

            // Store guard for later access
            session(['auth_guard' => 'web']);

            return $next($request);
        }

        // If not authenticated with 'web'
        $this->session->flush();
        $this->session->flash('CHECK_UNAUTHENTICATED', 'Please Sign in to start your session.');

        return redirect('/');
    }


}