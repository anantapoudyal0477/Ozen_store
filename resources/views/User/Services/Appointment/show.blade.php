@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Appointment Details')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4 max-w-3xl">

        <!-- Header -->
        <div class="mb-10 text-center">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                Appointment Details
            </h1>
            <p class="text-gray-600">View your scheduled eye checkup information</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

            <!-- Date -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Appointment Date</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y - h:i A') }}
                    </p>
                </div>
            </div>

            <!-- Message -->
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.8L3 20l1.8-3.2A7.963 7.963 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>

                <div class="flex-1">
                    <p class="text-sm text-gray-500 mb-1">Your Message</p>

                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-gray-700 leading-relaxed">
                        {{ $appointment->message ?? 'No message provided.' }}
                    </div>
                </div>
            </div>

            <!-- Status Badge (optional enhancement) -->
            <div class="mt-6">
                <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-full font-semibold text-sm">
                    Confirmed Appointment
                </span>
            </div>

        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>
                Back
            </a>
        </div>

    </div>
</div>

@endsection
