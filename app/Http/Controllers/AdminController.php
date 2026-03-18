<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admins')->user();
        $this->setPageTitle('Admin Dashboard');
        // $data = $this->getAllModelDataForAdmin();
        // dd([$data,$Navigation]);
        return $this->renderAdminViewPage('Administrator.homepage.index','Admin Home page',['admin'=>$admin]);


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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();          // Invalidate session
        $request->session()->regenerateToken();     // Prevent CSRF reuse

        return redirect()->route('Login.index')
            ->with('message', 'Logged out successfully');

    }
}
