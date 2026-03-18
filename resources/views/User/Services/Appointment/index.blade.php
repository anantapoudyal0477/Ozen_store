@extends('user.user-layout-page')

@section('title', $pageTitle ?? 'Eye Checkups')

@section('content')
<div class="max-w-5xl mx-auto py-6">



    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Eye Checkups</h2>
        <a href="{{ route('User.services.appointment.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
           Book Appointment
        </a>
    </div>

    <!-- User Type Display -->
    <div class="mb-4 text-gray-700">
        <span class="font-medium">Logged in as:</span> {{ Auth::user()->user_type }}
    </div>

    <!-- Appointments Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Time</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Doctor</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($ListOfAppointment as $appointment)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-800">{{ $appointment->appointment_date }}</td>
                        <td class="px-6 py-3 text-sm text-gray-800">{{ $appointment->appointment_time }}</td>
                        <td class="px-6 py-3 text-sm text-gray-800">{{ $appointment->doctor->name }}</td>
                        <td class="px-6 py-3 text-sm">
                            <span class="px-2 py-1 rounded-lg text-white text-xs
                                {{ $appointment->status === 'pending' ? 'bg-yellow-500' :
                                   ($appointment->status === 'confirmed' ? 'bg-green-600' : 'bg-red-600') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-right text-sm">
                            <a href="{{ route('User.services.Appointment.show', $appointment->id) }}"
                               class="text-blue-600 hover:underline mr-2">View</a>
                            <a href="{{ route('User.services.Appointment.edit', $appointment->id) }}"
                               class="text-green-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('User.services.Appointment.destroy', $appointment->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure?')"
                                    class="text-red-600 hover:underline">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            No appointments booked yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
