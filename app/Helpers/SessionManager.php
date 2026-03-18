<?php

namespace App\Helpers;

use App\Models\CustomSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SessionManager
{
    public static function createSession($userId, $guard, $ip, $userAgent, $expiresAt = null)
    {
        $token = (string) Str::uuid();

        CustomSession::create([
            'user_id'    => $userId,
            'guard'      => $guard,
            'token'      => $token,
            'ip'         => $ip,
            'user_agent' => substr($userAgent, 0, 50),
            'expires_at' => $expiresAt,
        ]);

        return $token;
    }

    public static function validateSession($token, $guard)
    {
        $session = CustomSession::where('token', $token)
            ->where('guard', $guard)
            ->first();

        if (!$session) return false;

        if ($session->expires_at && Carbon::now()->greaterThan($session->expires_at)) {
            $session->delete();
            return false;
        }

        return $session;
    }

    public static function destroySession($token)
    {
        CustomSession::where('token', $token)->delete();
    }
}
