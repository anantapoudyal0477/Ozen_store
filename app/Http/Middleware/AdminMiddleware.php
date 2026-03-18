<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\SessionManager;
use App\Models\Administrator;
use Illuminate\Support\Facades\Cookie;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('VISNARY_ADMIN');
        if (!$token) {
            abort(401, 'Unauthorized: session token missing.');
        }

        $session = SessionManager::validateSession($token, 'admins', [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        if (!$session) {
            Cookie::queue(Cookie::forget('VISNARY_ADMIN'));
            abort(403, 'Unauthorized: invalid or expired session.');
        }

        $admin = Administrator::find($session->user_id);
        if (!$admin || !$admin->is_active) {
            SessionManager::destroySession($token);
            Cookie::queue(Cookie::forget('VISNARY_ADMIN'));
            abort(403, 'Unauthorized: admin inactive.');
        }

        $request->attributes->set('current_admin', $admin);
        $request->attributes->set('admin_session_id', $session->id);

        return $next($request);
    }
}
