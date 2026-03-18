@extends('user.user-layout-page')

@section('title', 'User Homepage')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-6">

    <!-- Welcome -->
    <h1 class="text-3xl font-bold text-gray-800 mb-2">
        Welcome, {{ $user->name }} 👋
    </h1>

    <p class="text-gray-600 mb-8">
        Manage your appointments and orders from here.
    </p>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-gray-500 text-sm">Appointments</p>
            <p class="text-3xl font-bold text-gray-800">
                {{ $user->userAppointments->count() }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-gray-500 text-sm">Orders</p>
            <p class="text-3xl font-bold text-gray-800">
                {{ $user->userOrders->count() }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-gray-500 text-sm">Wishlist</p>
            <p class="text-3xl font-bold text-gray-800">
                {{ $user->userWishlists->count() }}
            </p>
        </div>

    </div>

    <!-- Recent Appointments -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            Recent Appointments
        </h2>

        @forelse ($user->userAppointments->take(5) as $appointment)
            <div class="border-b py-3 flex justify-between">
                <span>{{ $appointment->appointment_date }}</span>
                <span class="text-sm text-gray-600">
                    {{ ucfirst($appointment->status ?? 'pending') }}
                </span>
            </div>
        @empty
            <p class="text-gray-500">No appointments yet.</p>
        @endforelse
    </div>

    <!-- Actions -->
    <div class="flex gap-4">
        <a href="{{ route('User.services.appointment.create') }}"
           class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
            Book Appointment
        </a>

        <a href="{{ route('User.services.appointment.index') }}"
           class="border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-100 transition">
            View Appointments
        </a>
    </div>

</div>
@endsection
