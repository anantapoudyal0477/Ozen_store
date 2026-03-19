@extends('User.user-layout-page')

@section('title', 'Create Appointment')

@section('content')

<div class="max-w-3xl mx-auto py-8">

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Book an Appointment
    </h2>

    <form action="{{ route('User.services.appointment.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Selected Doctor Hidden Input -->
        <input type="hidden" name="doctor_id" id="selected_doctor_id" required>

        <!-- Doctor Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">
                Select Doctor
            </label>

            <div id="doctor-cards-container">
                @include('User.Components.DoctorCard.index', ['doctors' => $ListOfDoctors])
            </div>

            <div class="mt-4" id="doctor-pagination-links">
                {!! $ListOfDoctors->links() !!}
            </div>
        </div>

        <!-- Appointment Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Appointment Date
            </label>
            <input type="date" name="appointment_date" required
                class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <!-- Reason -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Reason for Visit
            </label>
            <textarea name="reason" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2"
                placeholder="Describe your issue..."></textarea>
        </div>

        <!-- Submit -->
        <div class="flex justify-end gap-3">
            <button type="reset" class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-100">
                Clear
            </button>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Book Appointment
            </button>
        </div>
    </form>

</div>

@push('scripts')
<script>
$(document).ready(function() {

    // Handle doctor card click using event delegation
    $(document).on('click', '.doctor-card', function () {
        $('.doctor-card').removeClass('ring-2 ring-blue-500 bg-blue-50');
        $(this).addClass('ring-2 ring-blue-500 bg-blue-50');

        let doctorId = $(this).data('doctor-id');
        $('#selected_doctor_id').val(doctorId);
    });

    // Handle pagination link click
    $(document).on('click', '#doctor-pagination-links a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchDoctors(url);
    });

    // Fetch doctors via AJAX
    function fetchDoctors(url) {
        let selectedDoctorId = $('#selected_doctor_id').val();

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update doctor cards and pagination links
                $('#doctor-cards-container').html(data.html);
                $('#doctor-pagination-links').html(data.pagination);

                // Restore previously selected doctor highlight
                if (selectedDoctorId) {
                    $(`.doctor-card[data-doctor-id="${selectedDoctorId}"]`).addClass('ring-2 ring-blue-500 bg-blue-50');
                }
            },
            error: function (xhr) {
                console.error('Error fetching doctors:', xhr);
            }
        });
    }

});
</script>
@endpush

@endsection
