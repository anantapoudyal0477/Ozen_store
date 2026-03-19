@extends('User.user-layout-page')

@section('title', 'Create Appointment')

@section('content')

<div class="max-w-3xl mx-auto py-8">

    <!-- ✅ Custom Alert -->
    <div id="custom-alert" 
        style="display:none; position:fixed; top:20px; right:20px; 
        background:#16a34a; color:white; padding:12px 20px; 
        border-radius:6px; box-shadow:0 4px 10px rgba(0,0,0,0.2); z-index:9999;">
    </div>

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Book an Appointment
    </h2>

    <form id="appointment-form" action="{{ route('User.services.appointment.store') }}" method="POST" class="space-y-5">
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
            <textarea name="reason" rows="3" 
                class="w-full border border-gray-300 rounded-md px-3 py-2"
                placeholder="Describe your issue..."></textarea>
        </div>

        <!-- Submit -->
        <div class="flex justify-end gap-3">
            <button type="reset" class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-100">
                Clear
            </button>
            <button type="submit" id="submit-btn"
                class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Book Appointment
            </button>
        </div>
    </form>

</div>

@push('scripts')
<script>
$(document).ready(function() {

    // ✅ Select doctor
    $(document).on('click', '.doctor-card', function () {
        $('.doctor-card').removeClass('ring-2 ring-blue-500 bg-blue-50');
        $(this).addClass('ring-2 ring-blue-500 bg-blue-50');

        let doctorId = $(this).data('doctor-id');
        $('#selected_doctor_id').val(doctorId);
    });

    // ✅ Pagination AJAX
    $(document).on('click', '#doctor-pagination-links a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        fetchDoctors(url);
    });

    function fetchDoctors(url) {
        let selectedDoctorId = $('#selected_doctor_id').val();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#doctor-cards-container').html(data.html);
                $('#doctor-pagination-links').html(data.pagination);

                if (selectedDoctorId) {
                    $(`.doctor-card[data-doctor-id="${selectedDoctorId}"]`)
                        .addClass('ring-2 ring-blue-500 bg-blue-50');
                }
            }
        });
    }

    // ✅ AJAX FORM SUBMIT
    $('#appointment-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();
        let submitBtn = $('#submit-btn');

        submitBtn.prop('disabled', true).text('Booking...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,

            success: function (response) {
                showAlert(response.message, 'success');

                form.trigger('reset');
                $('.doctor-card').removeClass('ring-2 ring-blue-500 bg-blue-50');
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '';

                    $.each(errors, function (key, value) {
                        errorMsg += value[0] + ' ';
                    });

                    showAlert(errorMsg, 'error');
                } else {
                    showAlert('Something went wrong.', 'error');
                }
            },

            complete: function () {
                submitBtn.prop('disabled', false).text('Book Appointment');
            }
        });
    });

    // ✅ Custom Alert Function
    function showAlert(message, type) {
        let alertBox = $('#custom-alert');

        alertBox.stop(true, true); // stop previous animations
        alertBox.text(message);

        if (type === 'success') {
            alertBox.css('background', '#16a34a');
        } else {
            alertBox.css('background', '#dc2626');
        }

        alertBox.fadeIn();

        setTimeout(() => {
            alertBox.fadeOut();
        }, 3000);
    }

});
</script>
@endpush

@endsection