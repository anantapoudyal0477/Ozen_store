<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StorePrescriptionGlasses;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\PrescriptionGlasses;
use App\Http\Requests\StorePrescriptionGlassesRequest;
use App\Http\Requests\UpdatePrescriptionGlassesRequest;
use App\Models\EyeLens;
use App\Models\prescriptions;

use App\Models\Order;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;


class User_ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->renderUserViewPage('User.Services.index','services',['ListOfServices' => Services::all()]);
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


public function indexPrescription()
{
    $prescriptions = Prescriptions::with('eyes')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
        // dd($prescriptions);

    return $this->renderUserViewPage(
        'User.services.PrescriptionGlasses.index',
        'services',
        ['prescriptions' => $prescriptions]
    );
}



public function createPrescription(Request $request)
{
        return $this->renderUserViewPage('User.services.PrescriptionGlasses.create','services');

}

    public function FrameForPrescriptionGlasses(Request $request)
    {
        // dd($request->all());
        $key ="FrameForPrescriptionGlasses";
        $EyePowerData =[
            ['left_sphere'    => $request->left_sphere ?? null],
            ['right_sphere'   => $request->right_sphere ?? null],
            ['left_cylinder'  => $request->left_cylinder ?? null],
            ['right_cylinder' => $request->right_cylinder ?? null],
            ['left_axis'      => $request->left_axis ?? null],
            ['right_axis'     => $request->right_axis ?? null],
            ['pd'             => $request->pd ?? null],
        ];
         $request->session()->put('EyePowerData', $EyePowerData); // Store data
        // return $this->renderUserViewPage('user.product.index', 'products', ['key' => $key]);
        return redirect()->route('User.products.index', ['type' => $key]);

    }

    public function editPrescription(int $id)
    {
        $prescription = PrescriptionGlasses::findOrFail($id);
        return $this->renderUserViewPage('User.services.PrescriptionGlasses.edit','services',['prescription' => $prescription]);
    }
public function storePrescription(Request $request)
{
    $request->validate([
        'EyeData' => 'required|array',
    ]);

    $userId = Auth::id();

    // Convert array → associative
    $data = [];
    foreach ($request->EyeData as $row) {
        $data = array_merge($data, $row);
    }

    // Create Prescription (no order yet)
    $prescription = prescriptions::create([
        'user_id' => $userId,
        'pd' => $data['pd'] ?? null,
    ]);

    // LEFT EYE
    PrescriptionGlasses::create([
        'prescription_id' => $prescription->id,
        'eye' => 'left',
        'sphere' => $data['left_sphere'] ?? null,
        'cylinder' => $data['left_cylinder'] ?? null,
        'axis' => $data['left_axis'] ?? null,
    ]);

    // RIGHT EYE
    PrescriptionGlasses::create([
        'prescription_id' => $prescription->id,
        'eye' => 'right',
        'sphere' => $data['right_sphere'] ?? null,
        'cylinder' => $data['right_cylinder'] ?? null,
        'axis' => $data['right_axis'] ?? null,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Prescription saved successfully'
    ]);
}



    public function EyesCheckups()
    {
    }
    public function storeEyesCheckups(Request $request)
    {
        //
    }

}
