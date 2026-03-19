<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class User_AppointmentController extends Controller
{
    const NO_OF_DOCTOR_PER_PAGE = 6;

    /**
     * Display a listing of appointments.
     */
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();

        return $this->renderUserViewPage(
            'User.Services.Appointment.index',
            'services',
            ['ListOfAppointment' => $appointments]
        );
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create(Request $request)
    {
        $doctors = Doctor::with(['profile', 'schedules'])
            ->paginate(self::NO_OF_DOCTOR_PER_PAGE);

        // AJAX request (pagination / dynamic loading)
        if ($request->ajax()) {
            $html = view('User.Components.DoctorCard.index', compact('doctors'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => (string) $doctors->links()
            ]);
        }

        // ✅ FIXED: correct case-sensitive path
        return $this->renderUserViewPage(
            'User.Services.Appointment.create',
            'services',
            ['ListOfDoctors' => $doctors]
        );
    }

    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'reson' => 'nullable|string|max:500',
        ]);
dd($validated);
        Appointment::create([
            'user_id' => Auth::id(),
            ...$validated
        ]);

        return response()->json([
            'message' => 'Appointment booked successfully.'
        ], 200);
    }

    /**
     * Optional AJAX fetch (clean version)
     */
    public function fetchDoctors(Request $request)
    {
        $doctors = Doctor::with(['profile', 'schedules'])
            ->paginate(self::NO_OF_DOCTOR_PER_PAGE);

        return view('User.Components.DoctorCard.index', compact('doctors'))->render();
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
