
@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

EyeCheckups show
<h2>Appointment Details</h2>
<p>Date: {{ $appointment->appointment_date }}</p>
<p>Message: {{ $appointment->message }}</p>

@endsection
