@extends('administrator.admin-layout-page')

@section('title', $pageTitle)

@section('content')

<!-- Dashboard Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
    @include('Administrator.components.dashboard.card.index', ['title' => 'Orders', 'count' => $totalOrders, 'color' => 'blue','route_name'=>"Administrator.Orders.index"])
    @include('Administrator.components.dashboard.card.index', ['title' => 'Customers', 'count' => $totalCustomers, 'color' => 'green','route_name'=>"Administrator.UsersManagement.index"])
    @include('Administrator.components.dashboard.card.index', ['title' => 'Doctors', 'count' => $totalDoctors, 'color' => 'purple','route_name'=>"Administrator.Doctors.index"])
    @include('Administrator.components.dashboard.card.index', ['title' => 'Appointments', 'count' => $totalAppointments, 'gradient' => 'from-orange-500 to-red-500', 'id' => 'openAppointmentsModal','route_name'=>"Administrator.Appointment.index"])
</div>

<!-- Include Appointments Modal -->
@include('Administrator.components.dashboard.modal.appointments.index', ['appointments' => $upcomingAppointments])

@endsection
