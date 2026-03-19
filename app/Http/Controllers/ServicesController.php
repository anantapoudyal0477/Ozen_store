<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;


class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicesList = Services::all();
        return $this->renderViewerPage('Viewer.Services.Services', 'Services',["servicesList"=>$servicesList]);
    }
        public function submit(){}

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
        $services = Services::findOrFail($id);
        return $this->renderViewerPage('Viewer.Services.ServicesDetail', 'Service Detail', ["services"=>$services]);
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
}
