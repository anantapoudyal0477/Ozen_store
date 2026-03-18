@props(['appointments'])

<div id="appointmentsModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden justify-center items-center p-4 z-[1000] transition-all duration-300">
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 w-full max-w-2xl rounded-3xl shadow-2xl p-8 relative border border-white/10 transform transition-all duration-300">
        <!-- Close Button -->
        <button id="closeAppointmentsModal" class="absolute top-6 right-6 text-gray-400 hover:text-white text-3xl transition-colors duration-200 hover:rotate-90 transform">&times;</button>

        <!-- Header -->
        <div class="flex items-center space-x-3 mb-6">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 p-3 rounded-2xl">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-black text-white">Upcoming Appointments</h2>
        </div>

        <p class="text-gray-400 mb-6">Next 2 hours</p>

        <!-- Appointments List -->
        <div class="space-y-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
            @if($appointments->count() > 0)
                @foreach($appointments as $appt)
                    <div class="group p-5 bg-gradient-to-r from-gray-700/50 to-gray-800/50 rounded-2xl border border-white/5 hover:border-orange-500/50 transition-all duration-300 hover:scale-102 backdrop-blur-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">{{ substr($appt->patient_name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="text-xl font-bold text-white">{{ $appt->patient_name }}</p>
                                    <p class="text-gray-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Dr. {{ $appt->doctor_name }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="bg-orange-500/20 px-4 py-2 rounded-xl border border-orange-500/30">
                                    <p class="text-orange-400 font-bold">{{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg">No appointments in the next 2 hours</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Appointment Modal Script -->
<script>
    const openBtn = document.getElementById('openAppointmentsModal');
    const modal = document.getElementById('appointmentsModal');
    const closeBtn = document.getElementById('closeAppointmentsModal');

    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });
</script>
