@if ($errors->any())
    <div id="error-messages" class="max-w-md mx-auto mb-4 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg shadow-md flex items-start space-x-3 cursor-pointer">
        <!-- Icon -->
        <svg class="w-6 h-6 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12A9 9 0 11.999 12a9 9 0 0120.001 0z"></path>
        </svg>

        <!-- Error Messages -->
        <div class="flex-1">
            <p class="font-semibold">Error!</p>
            <p class="text-sm">Please fix the following issues:</p>
            <ul class="list-disc list-inside text-sm mt-1 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <p class="text-xs italic mt-1">Click to dismiss</p>
        </div>
    </div>

    <script src="{{ asset('js/Jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Fade out on click
            $("#error-messages").click(function() {
                $(this).fadeOut(400);
            });
        });
    </script>
@endif
