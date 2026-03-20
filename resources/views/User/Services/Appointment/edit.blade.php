@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Edit Appointment')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4 max-w-3xl">

        <!-- Header -->
        <div class="mb-10 text-center">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5h2m-1-2v4m-7 4h14M5 21h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                Edit Appointment
            </h1>
            <p class="text-gray-600">Update your scheduled eye checkup details</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

            <form action="{{ route('User.services.appointment.update', $appointment->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Appointment Date *
                    </label>
                    <input type="datetime-local"
                           name="appointment_date"
                           value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Message (Optional)
                    </label>
                    <textarea name="message" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                        placeholder="Add any notes or requests...">{{ $appointment->message }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>

                        Update Appointment
                    </button>

                    <a href="{{ url()->previous() }}"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
