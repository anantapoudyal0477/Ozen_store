@extends('administrator.admin-layout-page')
@section('title', 'Sales Report')

@section('content')

<h2 class="text-xl font-bold mb-4">Sales Report</h2>

<!-- Date Filter -->
<div class="flex items-center gap-2 mb-4">
    <input type="date" id="start_date" class="border px-2 py-1 rounded">
    <input type="date" id="end_date" class="border px-2 py-1 rounded">
    <button id="filterBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Filter
    </button>
    <button id="clearFilterBtn" class="hidden bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        clear
    </button>
    <span id="filterMessage" class="ml-4 text-green-600 font-semibold"></span>
</div>

<!-- Search -->
<div class="flex items-center gap-2 mb-4">
    <input type="text" id="searchQuery" placeholder="Search by order # or customer name" class="border px-2 py-1 rounded flex-1">
    <button id="searchBtn" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Search</button>
</div>

<!-- Orders Table -->
<div id="ordersTable">
    @include('Administrator.Components.Sales.table.index', ['orders' => $orders])
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function(){

$('#filterBtn').click(function() {
    let start = $('#start_date').val();
    let end = $('#end_date').val();

    // Check if both dates are empty
    if (start === "" && end === "") {
        alert("Please select at least one date to filter.");
        return;
    }

    // Prepare data to send
    let data = {};
    if (start !== "") data.start_date = start;
    if (end !== "") data.end_date = end;

    $.get("{{ route('Administrator.Sales.filterDate') }}", data, function(res) {
        // Update the table
        $('#ordersTable').html(res.html);

        // Update filter message based on selected dates
        let message = "";
        if (start !== "" && end !== "") {
            message = `Showing orders from ${start} to ${end}`;
        } else if (start !== "") {
            message = `Showing orders from ${start}`;
        } else if (end !== "") {
            message = `Showing orders up to ${end}`;
        }

        $('#filterMessage').text(message);

        // Show clear filter button
        $('#clearFilterBtn').show();
    });
});

// Clear filter logic
$('#clearFilterBtn').click(function() {
    $('#start_date').val('');
    $('#end_date').val('');
    $('#filterMessage').text('');
    $('#clearFilterBtn').hide();

    // Reload full table
    $.get("{{ route('Administrator.Sales.filterDate') }}", function(res) {
        $('#ordersTable').html(res.html);
    });
});

 
    // Search
    $('#searchBtn').click(function(){
        let query = $('#searchQuery').val();
        $.get("{{ route('Administrator.Sales.search') }}", {query: query}, function(res){
            $('#ordersTable').html(res.html);
        });
    });

    // Pagination (delegated)
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        $.get(url, function(res){
            $('#ordersTable').html(res);
        });
    });
});
</script>

@endsection
