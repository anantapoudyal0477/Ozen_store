<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return $this->renderViewerPage('Viewer.Contact.Contact','Contact us');;
    }

    public function StayConnected(){
        $ownerName = "Ozen Eye Wear";
        $address = "123 Main Street, City, Country";
        $email = "ozen@gamil.com";
        $phone = "9779744593083";
        $facebookLink = "https://www.facebook.com/profile.php?id=61587742575807&mibextid=wwXIfr";
        $instagramLink = "https://www.instagram.com/ozen_eye_wear?igsh=MTQ5Zm10aWRjazNrYQ%3D%3D";
        $tiktokLink = "https://www.tiktok.com/@ozeneyewear2";
        $whatsappLink = "https://wa.me/".$phone;
        return view("Viewer.Components.URL.index",compact('ownerName', 'address', 'email', 'phone', 'facebookLink', 'instagramLink', 'tiktokLink', 'whatsappLink'));
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
