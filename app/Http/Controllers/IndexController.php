<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewerHomeHero;
use App\Models\ViewerHomeFeatures;
use App\Models\ViewerHome_cta;
use App\Models\ViewerHomeHeroStats;



class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $HomeHero =ViewerHomeHero::all();
        $HomeFeatures = ViewerHomeFeatures::all();
        $HomeCTA = ViewerHome_cta::all();
        $HomeStats = ViewerHomeHeroStats::all();


        return $this->renderViewerPage('Viewer.Homepage', 'Home',[
            'HomeHeroData'=>$HomeHero,
            'HomeFeaturesData'=>$HomeFeatures,
            'HomeCTAData'=>$HomeCTA,
            'HomeStatsData'=>$HomeStats,
        ]);
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
}
