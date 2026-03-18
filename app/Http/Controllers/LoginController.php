<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Helpers\SessionManager;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->renderViewerPage('Login', 'Login');
    }
public function submit(Request $request)
{
    $credentials = $request->validate([
        'email'=>'required|email',
        'password'=>'required|string|min:6',
    ]);

    $key = Str::lower($request->email).'|'.$request->ip();

    if (RateLimiter::tooManyAttempts($key,5)) {
        $seconds = RateLimiter::availableIn($key);
        return back()->withErrors(['email'=>"Too many attempts. Try again in $seconds seconds."]);
    }

    RateLimiter::hit($key,60);

    // dd(Auth::guard('users')->attempt($credentials));
    if (Auth::guard('users')->attempt($credentials)) {
        $user = Auth::guard('users')->user();
        $token = SessionManager::createSession($user->id,'users',$request->ip(),$request->userAgent(), null); // can be null
        RateLimiter::clear($key);

        return redirect()->route('User.Homepage.index')
            ->with('message','Login successful')
            ->cookie('VISNARY_USER',$token,120);
    }

    RateLimiter::hit($key,60);
    return back()->withErrors(['email'=>'Invalid credentials'])->withInput();
}

public function logout(Request $request)
{
    Auth::guard('users')->logout();
    $token = $request->cookie('VISNARY_USER');
    if ($token) SessionManager::destroySession($token);

    return redirect()->route('Login.index')
        ->with('message','Logged out successfully')
        ->withoutCookie('VISNARY_USER');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Login $login)
    {
        //
    }
}
