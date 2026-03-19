@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')
<form action="{{ route('User.services.PrescriptionGlasses.FrameForPrescriptionGlasses') }}" method="POST">
    @csrf
    @method("POST")

    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Prescription Details
            </h2>
            <p class="text-gray-600">Enter your prescription values for both eyes</p>
        </div>

        <!-- Main Prescription Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Eye Icons Header -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-200">
                <div class="grid grid-cols-2 gap-8">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Left Eye</h3>
                            <p class="text-sm text-gray-600">OS (Oculus Sinister)</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Right Eye</h3>
                            <p class="text-sm text-gray-600">OD (Oculus Dexter)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prescription Values Grid -->
            <div class="p-8">
                <div class="grid grid-cols-2 gap-8">
                    <!-- Left Eye Column -->
                    <div class="space-y-5">
                        <!-- SPH -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold text-xs">
                                    SPH
                                </span>
                                Sphere
                            </label>
                            <input type="text" name="left_sphere" id="left_sphere"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gradient-to-br from-white to-blue-50"
                                placeholder="e.g., -2.00">
                        </div>

                        <!-- CYL -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold text-xs">
                                    CYL
                                </span>
                                Cylinder
                            </label>
                            <input type="text" name="left_cylinder" id="left_cylinder"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gradient-to-br from-white to-blue-50"
                                placeholder="e.g., -0.75">
                        </div>

                        <!-- AXIS -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold text-xs">
                                    AXS
                                </span>
                                Axis
                            </label>
                            <input type="text" name="left_axis" id="left_axis"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gradient-to-br from-white to-blue-50"
                                placeholder="e.g., 180°">
                        </div>
                    </div>

                    <!-- Right Eye Column -->
                    <div class="space-y-5">
                        <!-- SPH -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold text-xs">
                                    SPH
                                </span>
                                Sphere
                            </label>
                            <input type="text" name="right_sphere" id="right_sphere"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-gradient-to-br from-white to-indigo-50"
                                placeholder="e.g., -2.00">
                        </div>

                        <!-- CYL -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold text-xs">
                                    CYL
                                </span>
                                Cylinder
                            </label>
                            <input type="text" name="right_cylinder" id="right_cylinder"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-gradient-to-br from-white to-indigo-50"
                                placeholder="e.g., -0.75">
                        </div>

                        <!-- AXIS -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold text-xs">
                                    AXS
                                </span>
                                Axis
                            </label>
                            <input type="text" name="right_axis" id="right_axis"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-gradient-to-br from-white to-indigo-50"
                                placeholder="e.g., 180°">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PD (Pupillary Distance) Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <label class="block text-lg font-bold text-gray-800 mb-2">
                        Pupillary Distance (PD)
                    </label>
                    <p class="text-sm text-gray-600 mb-4">Distance between the centers of your pupils in millimeters</p>
                    <input type="text" name="pd" id="pd"
                        class="w-full px-4 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-gradient-to-br from-white to-purple-50 text-lg font-semibold"
                        placeholder="e.g., 63 mm">
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-600 rounded-xl p-6">
            <div class="flex gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm text-gray-700">
                    <p class="font-semibold mb-1">Tip: How to read your prescription</p>
                    <p>SPH (Sphere) indicates nearsightedness (-) or farsightedness (+). CYL (Cylinder) measures astigmatism. AXIS shows the orientation of astigmatism (0-180°). PD is typically between 54-74mm.</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Continue to Frame Selection
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </button>
        </div>
    </div>
</form>
@endsection
