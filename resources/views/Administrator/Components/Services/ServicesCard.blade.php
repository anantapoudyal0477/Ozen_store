<section class="py-16 container mx-auto px-4">
    <div class="grid md:grid-cols-3 gap-8">
        @if (!isset($servicesList) || $servicesList->isEmpty())
            <p class="text-center text-gray-500 col-span-3">No services available at the moment. Please check back later.
            </p>

        @else
            @foreach ($servicesList as $list)
            <form action="{{route('Services.show',$list->id)}}" method="GET">
                @csrf
                <input type="hidden" name="service_id" value="{{ $list->id }}">
<div
                    class="relative bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-transform duration-300 hover:-translate-y-2 border border-gray-100">

                    <!-- Icon -->
                    <div
                        class="mx-auto flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-md -mt-12 mb-6">
                        <i class="fas fa-glasses text-2xl"></i>
                    </div>

                    <!-- Title -->
                    <h3 class="text-2xl font-extrabold mb-3 text-gray-800">
                        {{ $list->name }}
                    </h3>

                    <!-- Description -->
                    <p class="text-gray-600 mb-6">
                        {{ $list->description }}
                    </p>

                    <!-- Button -->
                    <button type="submit"
                        class="inline-block mt-4 px-6 py-2 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-medium shadow hover:scale-105 transition-transform duration-300">
                        Learn More
                </button>
                </div>
            </form>

            @endforeach

        @endif

    </div>
</section>
<!-- End of Services Section -->
