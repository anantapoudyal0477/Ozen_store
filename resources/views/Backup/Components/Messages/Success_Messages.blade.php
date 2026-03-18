@if (session('message'))
    <div id="success-message" class="max-w-md mx-auto mb-4 bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg shadow-md flex items-start space-x-3 cursor-pointer">
        <!-- Icon -->
        <svg class="w-6 h-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>

        <!-- Message -->
        <div class="flex-1">
            <p class="font-semibold">Success!</p>
            <p class="text-sm">{{ session('message') }}</p>
            <p class="text-xs italic mt-1">Click to dismiss</p>
        </div>
    </div>

    <script src="{{asset('js/Jquery.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Fade out on click
            $("#success-message").click(function() {
                $(this).fadeOut(400);
            });


        });
    </script>
@endif
