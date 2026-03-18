<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @foreach($doctors as $doctor)
        @php
            $schedule = $doctor->schedules->first();
            $workingDays = $schedule ? implode(', ', $schedule->working_days) : 'N/A';
            $startTime = $schedule ? \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') : '';
            $endTime = $schedule ? \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') : '';
        @endphp

        <div class="doctor-card cursor-pointer border rounded-lg p-4 hover:shadow-md transition bg-white"
             data-doctor-id="{{ $doctor->id }}">
            <div class="flex items-center gap-4">
                <img src="{{ $doctor->profile->photo_url ? asset($doctor->profile->photo_url) : asset('images/default-doctor.png') }}"
                     alt="Doctor" class="rounded-full object-cover border" width="150px">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">{{ $doctor->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $doctor->profile->specialization ?? 'General Physician' }}</p>
                    <div class="flex flex-col gap-1 mt-1 text-xs text-gray-700">
                        <span>Designation: {{ $doctor->profile->designation ?? 'N/A' }}</span>
                        <span>Experience: {{ $doctor->profile->experience_years ?? 'N/A' }} yrs</span>
                        <span>Fee: ${{ $doctor->profile->consultation_fee ?? '0.00' }}</span>
                        @if($schedule)
                            <span>Working Days: {{ $workingDays }}</span>
                            <span>Hours: {{ $startTime }} - {{ $endTime }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
