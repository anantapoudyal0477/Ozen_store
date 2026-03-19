@extends('Administrator.admin-layout-page')
@section('title', $pageTitle ?? "Appointments Management")
@section('content')


  {{-- @foreach($ListOfDoctors as $doctor)
                        {{ $doctor->user->name}}
                    @endforeach --}}
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">{{ $pageTitle ?? "Appointments Management" }}</h2>
        <button id="openCreateModal" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">+ New Appointment</button>
    </div>

    @if($ListOfAppointments->isEmpty())
        <p class="text-gray-600">No appointments found.</p>
    @else
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-5 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                        <th class="px-5 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Time</th>
                        <th class="px-5 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($ListOfAppointments as $appointment)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $appointment->id }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $appointment->full_name ?? $appointment->user->name ?? 'N/A' }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $appointment->appointment_date }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $appointment->appointment_time }}</td>
                        <td class="px-5 py-4 text-sm">
                            @if($appointment->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold">Pending</span>
                            @elseif($appointment->status === 'confirmed')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Confirmed</span>
                            @elseif($appointment->status === 'cancelled')
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-semibold">{{ ucfirst($appointment->status) }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm">
                            <button
                                class="viewAppointmentBtn bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition"
                                data-appointment="{{ json_encode($appointment->load('user','doctor')) }}">
                                View
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<!-- View Appointment Modal -->
<div id="appointmentModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full p-6 relative overflow-y-auto max-h-[90vh]">
        <button id="closeModal" class="absolute top-4 right-4 text-gray-600 hover:text-red-500 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Appointment Details</h2>
        <div id="modalContent" class="space-y-2 text-gray-700 text-sm"></div>
    </div>
</div>

<!-- Create Appointment Modal -->
<div id="createModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full p-6 relative overflow-y-auto max-h-[90vh]">
        <button id="closeCreateModal" class="absolute top-4 right-4 text-gray-600 hover:text-red-500 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Create New Appointment</h2>

        <form id="createAppointmentForm" method="POST" action="{{ route('Administrator.Appointment.store') }}" class="space-y-4">
            @csrf

            <label class="block">
                <span class="text-gray-700">Customer Name</span>
                <input type="text" name="full_name" placeholder="Enter customer name"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"/>
            </label>

            <label class="block">
                <span class="text-gray-700">Email (optional)</span>
                <input type="email" name="email" placeholder="Customer email"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"/>
            </label>

            <label class="block">
                <span class="text-gray-700">Contact Number</span>
                <input type="text" name="contact_number" placeholder="Customer contact"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"/>
            </label>
            <label class="block">
                <span class="text-gray-700">Select Doctor</span>
                <select name="doctor_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($ListOfDoctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block">
                <span class="text-gray-700">Appointment Date</span>
                <input type="date" name="appointment_date"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"/>
            </label>

            <label class="block">
                <span class="text-gray-700">Appointment Time</span>
                <input type="time" name="appointment_time"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"/>
            </label>

            <label class="block">
                <span class="text-gray-700">Status</span>
                <select name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </label>

            <label class="block">
                <span class="text-gray-700">Message (optional)</span>
                <textarea name="message" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </label>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Create Appointment</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function(){

    // View appointment modal
    $(".viewAppointmentBtn").click(function(){
        let appointment = $(this).data("appointment");
        let html = `
            <p><strong>Customer Name:</strong> ${appointment.full_name ?? appointment.user?.name ?? 'N/A'}</p>
            <p><strong>Doctor:</strong> ${appointment.doctor?.name ?? 'N/A'}</p>
            <p><strong>Email:</strong> ${appointment.email ?? 'N/A'}</p>
            <p><strong>Contact:</strong> ${appointment.contact_number ?? 'N/A'}</p>
            <p><strong>Appointment Date:</strong> ${appointment.appointment_date}</p>
            <p><strong>Appointment Time:</strong> ${appointment.appointment_time}</p>
            <p><strong>Status:</strong> ${appointment.status}</p>
            <p><strong>Message:</strong> ${appointment.message ?? '-'}</p>
            <p><strong>Created At:</strong> ${appointment.created_at}</p>
            <p><strong>Updated At:</strong> ${appointment.updated_at}</p>
        `;
        $("#modalContent").html(html);
        $("#appointmentModal").removeClass("hidden");
    });
    $("#closeModal").click(function(){ $("#appointmentModal").addClass("hidden"); });

    // Open/Close Create Appointment modal
    $("#openCreateModal").click(function(){ $("#createModal").removeClass("hidden"); });
    $("#closeCreateModal").click(function(){ $("#createModal").addClass("hidden"); });
});
</script>
@endsection
