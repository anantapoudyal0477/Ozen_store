<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\SessionManager;

class UsersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('VISNARY_USER');
        $session = $token ? SessionManager::validateSession($token, 'users') : null;

        if (!$session) abort(403, 'Unauthorized: invalid or expired token.');

        $request->merge(['current_user' => $session->user_id]);

        return $next($request);
    }
}
