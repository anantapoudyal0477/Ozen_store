@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Your Lens Collection
                </h1>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span class="font-medium">{{ $userLenses->count() }} Lenses</span>
                </div>
            </div>
            <p class="text-gray-600">Manage your prescription lenses and order replacements</p>
        </div>

        @if($userLenses->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl shadow-xl p-12 text-center border border-gray-100">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">No Lenses Yet</h3>
                    <p class="text-gray-600 mb-8">Start building your eyewear collection by ordering your first prescription lens</p>
                    <a href="{{ route('User.Services.LensReplacement.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Order Your First Lens
                    </a>
                </div>
            </div>
        @else
            <!-- Lens Cards Grid -->
            <div class="grid grid-cols-1 gap-6">
                @foreach($userLenses as $lens)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                    <div class="p-6">
                        <!-- Card Header -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $lens->lens_name }}</h3>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-medium">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $lens->lensType->type_name ?? 'Standard' }}
                                    </span>
                                    @if($lens->brand)
                                    <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full font-medium">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        {{ $lens->brand->name }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- <a href="{{ route('User.lens.order', $lens->id) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Order New
                            </a> --}}
                        </div>

                        <!-- Specifications Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <!-- Material -->
                            <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-4 border border-slate-200">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1 font-semibold">Material</p>
                                <p class="text-lg font-bold text-gray-800">{{ $lens->material->name ?? 'Standard' }}</p>
                            </div>

                            <!-- Sphere -->
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
                                <p class="text-xs text-blue-600 uppercase tracking-wider mb-1 font-semibold">Sphere (SPH)</p>
                                <p class="text-lg font-bold text-blue-900">{{ $lens->optics->sphere ?? '-' }}</p>
                            </div>

                            <!-- Cylinder -->
                            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-4 border border-indigo-200">
                                <p class="text-xs text-indigo-600 uppercase tracking-wider mb-1 font-semibold">Cylinder (CYL)</p>
                                <p class="text-lg font-bold text-indigo-900">{{ $lens->optics->cylinder ?? '-' }}</p>
                            </div>

                            <!-- Axis -->
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 border border-purple-200">
                                <p class="text-xs text-purple-600 uppercase tracking-wider mb-1 font-semibold">Axis</p>
                                <p class="text-lg font-bold text-purple-900">{{ $lens->optics->axis ?? '-' }}°</p>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        @if($lens->optics->add_power)
                        <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-amber-200 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-amber-700 font-semibold">Progressive/Bifocal Addition</p>
                                    <p class="text-lg font-bold text-amber-900">Add Power: {{ $lens->optics->add_power }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Footer CTA -->
            <div class="mt-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-8 text-center">
                <h3 class="text-2xl font-bold text-white mb-3">Need a New Prescription?</h3>
                <p class="text-blue-100 mb-6">Add another lens to your collection or update your existing prescriptions</p>
                <a href="#" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-blue-600 font-semibold px-8 py-3 rounded-xl transition-all duration-300 shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Lens
                </a>
            </div>
        @endif
    </div>
</div>

@endsection
