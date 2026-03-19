@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Add Lens Replacement')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-12">

    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Add New Lens Replacement
                </h1>
            </div>
            <p class="text-gray-600 ml-15">Fill in the details to add a new lens to your collection</p>
        </div>

        <!-- Form Container -->
        <form id="lensReplacementForm" action="{{ route('User.services.LensReplacement.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Basic Information Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Basic Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Lens Name -->
                    <div class="md:col-span-2">
                        <label for="lens_name" class="block text-sm font-semibold text-gray-700 mb-2">Lens Name *</label>
                        <input type="text" name="lens_name" id="lens_name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('lens_name') }}"
                            placeholder="e.g., Daily Comfort Plus"
                            required>
                    </div>

                    <!-- Lens Type -->
                    <div>
                        <label for="lens_type_id" class="block text-sm font-semibold text-gray-700 mb-2">Lens Type *</label>
                        <select name="lens_type_id" id="lens_type_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                            required>
                            <option value="">Select Lens Type</option>
                            @foreach($lensTypes as $type)
                                <option value="{{ $type->id }}" {{ old('lens_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->type_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand -->
                    <div>
                        <label for="brand_id" class="block text-sm font-semibold text-gray-700 mb-2">Brand *</label>
                        <select name="brand_id" id="brand_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                            required>
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Material -->
                    <div>
                        <label for="material_id" class="block text-sm font-semibold text-gray-700 mb-2">Material *</label>
                        <select name="material_id" id="material_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                            required>
                            <option value="">Select Material</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Wearing Replacement -->
                    <div>
                        <label for="wearing_replacement_id" class="block text-sm font-semibold text-gray-700 mb-2">Wearing Schedule *</label>
                        <select name="wearing_replacement_id" id="wearing_replacement_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                            required>
                            <option value="">Select Replacement Schedule</option>
                            @foreach($wearingReplacements as $wr)
                                <option value="{{ $wr->id }}">
                                    {{ $wr->replacement_cycle }} - {{ $wr->wearing_schedule }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Optical Specifications Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Optical Specifications</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="sphere" class="block text-sm font-semibold text-gray-700 mb-2">Sphere (SPH)</label>
                        <input type="text" name="sphere" id="sphere"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('sphere') }}"
                            placeholder="e.g., -2.00">
                    </div>

                    <div>
                        <label for="cylinder" class="block text-sm font-semibold text-gray-700 mb-2">Cylinder (CYL)</label>
                        <input type="text" name="cylinder" id="cylinder"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('cylinder') }}"
                            placeholder="e.g., -0.75">
                    </div>

                    <div>
                        <label for="axis" class="block text-sm font-semibold text-gray-700 mb-2">Axis (°)</label>
                        <input type="number" name="axis" id="axis"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('axis') }}"
                            placeholder="e.g., 180"
                            min="0" max="180">
                    </div>

                    <div>
                        <label for="add_power" class="block text-sm font-semibold text-gray-700 mb-2">Add Power</label>
                        <input type="text" name="add_power" id="add_power"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('add_power') }}"
                            placeholder="e.g., +1.50">
                    </div>
                </div>
            </div>

            <!-- Dimensions Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Dimensions</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="base_curve" class="block text-sm font-semibold text-gray-700 mb-2">Base Curve *</label>
                        <input type="text" name="base_curve" id="base_curve"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('base_curve') }}"
                            placeholder="e.g., 8.6"
                            required>
                    </div>

                    <div>
                        <label for="diameter" class="block text-sm font-semibold text-gray-700 mb-2">Diameter (mm) *</label>
                        <input type="text" name="diameter" id="diameter"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('diameter') }}"
                            placeholder="e.g., 14.2"
                            required>
                    </div>

                    <div>
                        <label for="water_content" class="block text-sm font-semibold text-gray-700 mb-2">Water Content (%)</label>
                        <input type="text" name="water_content" id="water_content"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('water_content') }}"
                            placeholder="e.g., 55">
                    </div>

                    <div>
                        <label for="oxygen_permeability" class="block text-sm font-semibold text-gray-700 mb-2">Oxygen Permeability (Dk/t)</label>
                        <input type="text" name="oxygen_permeability" id="oxygen_permeability"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('oxygen_permeability') }}"
                            placeholder="e.g., 138">
                    </div>
                </div>
            </div>

            <!-- Features Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Features & Appearance</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">Color</label>

                            <select name="color_id" id="color_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                            required>
                            <option value="">e.g., Clear, Blue, Green</option>
                            @foreach($colors as $cr)
                                <option value="{{ $cr->id }}">
                                    {{  $cr->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <label class="flex items-center gap-3 cursor-pointer bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl px-4 py-3 w-full hover:from-amber-100 hover:to-orange-100 transition-all duration-200">
                            <input type="checkbox" name="uv_protection" value="1" {{ old('uv_protection') ? 'checked' : '' }}
                                class="w-5 h-5 text-amber-600 rounded focus:ring-2 focus:ring-amber-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span class="font-semibold text-gray-700">UV Protection</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>


            <!-- Submit Button -->
            <div class="flex gap-4">
                <button id="submitEyeLensForm" type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Lens Replacement
                </button>
                <a href="{{ route('User.services.LensReplacement.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-8 rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    $('#lensReplacementForm').on('submit', function(event){
        event.preventDefault(); // prevent default submission

        let formData = new FormData(this); // get all form data

        $.ajax({
            url: "{{ route('User.services.LensReplacement.store') }}",
            type: "POST",
            data: formData,
            processData: false, // prevent jQuery from converting formData to string
            contentType: false, // let browser set content type (multipart/form-data)
            success: function(response){
                console.log(response);
                alert('Lens Replacement added successfully.');
                $('#lensReplacementForm')[0].reset(); // optional: reset form
            },
            error: function(xhr){
                console.log('Error in adding Lens Replacement.');
                if(xhr.status === 422){
                    let errors = xhr.responseJSON.errors;
                    console.log(errors); // validation errors
                }
            }
        });

    });

});

</script>

@endsection
