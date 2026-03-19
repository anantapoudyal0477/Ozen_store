<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class User_AppointmentController extends Controller
{
    const NO_OF_DOCTOR_PER_PAGE = 6;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ListOfAppointment = Appointment::where('user_id', Auth::id())->get();


        return $this->renderUserViewPage('User.Services.Appointment.index','services', ['ListOfAppointment' => $ListOfAppointment]);

    }

    /**
     * Show the form for creating a new resource.
     */
   public function create(Request $request)
{
    // Use pagination, 6 doctors per page
    $doctors = Doctor::with(['profile', 'schedules'])->paginate(6);

    if ($request->ajax()) {
        // Render only the doctor cards partial
        $html = view('User.Components.DoctorCard.index', compact('doctors'))->render();
        $pagination = (string) $doctors->links();
        return response()->json(['html' => $html, 'pagination' => $pagination]);
    }

    // Render full page for non-AJAX request
    return $this->renderUserViewPage(
        'User.services.Appointment.create',
        'services',
        ['ListOfDoctors' => $doctors] // pass same variable to full page
    );
}


// AJAX fetch for pagination
 public function fetchDoctors($page_no) {
    dd("hello");
    //  $doctors = Doctor::with(['profile','schedules'])->paginate(6);
    //   dd($doctors); // Only return the partial if AJAX
    //   if ($request->ajax()) { return view('User.components.DoctorCard.index', compact('doctors'))->render();
    // } // Redirect to create page if accessed directly
    //  return redirect()->route('User.services.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'doctor_id' => 'required|exists:users,id',
            'email' => 'nullable|email',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'message' => 'nullable|string|max:500',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            ...$validated
        ]);
        return response()->json(['message' => 'Appointment booked successfully.'], 200);

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
