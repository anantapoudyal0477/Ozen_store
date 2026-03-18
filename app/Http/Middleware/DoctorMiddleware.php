<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\SessionManager;

class DoctorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('VISNARY_DOCTOR');
        $session = $token ? SessionManager::validateSession($token, 'doctors') : null;

        if (!$session) abort(403, 'Unauthorized: invalid or expired token.');

        $request->merge(['current_doctor' => $session->user_id]);

        return $next($request);
    }
}
