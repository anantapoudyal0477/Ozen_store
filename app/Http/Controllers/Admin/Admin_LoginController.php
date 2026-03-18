<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Helpers\SessionManager;
use App\Models\Administrator;
use Carbon\Carbon;

class Admin_LoginController extends Controller
{
    /**
     * Show the admin login page.
     */
    public function index(): \Illuminate\View\View
    {
        return $this->renderViewerPage('Logins.Admin.index', 'Admin Login');
    }

    /**
     * Handle login submission securely.
     */
    public function submit(Request $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $key = Str::lower($request->email)
            . '|' . $request->ip()
            . '|' . substr($request->userAgent(), 0, 50);
        // ---------------- RATE LIMIT ----------------
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withErrors(['email' => "Too many attempts. Try again in $seconds seconds."])
                ->withInput();
        }

        // ---------------- AUTH ATTEMPT ----------------
        if (! Auth::guard('admins')->attempt($credentials, false)) {
            RateLimiter::hit($key, 60);

            /** @var Administrator|null $admin */
            $admin = Administrator::where('email', $credentials['email'])->first();
// dd($credentials,$key,$admin);

            if ($admin) {
                $admin->increment('failed_login_attempts');

                if ($admin->failed_login_attempts >= 5) {
                    $admin->update([
                        'locked_until' => now()->addMinutes(15),
                        'failed_login_attempts' => 0,
                    ]);
                }
            }

            usleep(random_int(200000, 500000)); // silent delay

            return back()
                ->withErrors(['email' => 'Invalid email or password.'])
                ->withInput();
        }

        /** @var Administrator $admin */
        $admin = Auth::guard('admins')->user();
        // ---------------- ACCOUNT STATUS CHECK ----------------
        if (! $admin->is_active) {
            Auth::guard('admins')->logout();
            return back()->withErrors(['email' => 'Account disabled.']);
        }

        if ($admin->locked_until && now()->lessThan($admin->locked_until)) {
            Auth::guard('admins')->logout();
            $remaining = $admin->locked_until->diffInMinutes(now());
            return back()->withErrors([
                'email' => "Account locked. Try again in $remaining minutes."
            ]);
        }

        // ---------------- ROLE CHECK ----------------
        if (! $admin->roles()->whereIn('name', ['admin', 'super_admin'])->exists()) {
            Auth::guard('admins')->logout();
            return back()->withErrors(['email' => 'Unauthorized access.']);
        }

        // ---------------- LOGIN SUCCESS ----------------
        RateLimiter::clear($key);

        $admin->update([
            'failed_login_attempts' => 0,
            'locked_until' => null,
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        $request->session()->regenerate();

        $token = SessionManager::createSession(
            $admin->id,
            'admins',
            $request->ip(),
            hash('sha256', $request->userAgent()),
            now()->addMinutes(120)
        );

        return redirect()
            ->route('Administrator.Homepage.index')
            ->with('message', 'Login successful')
            ->cookie(
                'VISNARY_ADMIN',
                $token,
                120,
                null,
                null,
                true,
                true
            );
    }

    /**
     * Logout the admin securely.
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('admins')->logout();

        if ($token = $request->cookie('VISNARY_ADMIN')) {
            SessionManager::destroySession($token);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('AdminLogin.index')
            ->with('message', 'Logged out successfully')
            ->withoutCookie('VISNARY_ADMIN');
    }
}
