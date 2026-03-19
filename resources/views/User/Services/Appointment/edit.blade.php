
@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

EyeCheckups edit
<form action="{{ route('User.services.appointment.update', $appointment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="date" name="appointment_date" value="{{ $appointment->appointment_date }}" required>

    <textarea name="message">{{ $appointment->message }}</textarea>

    <button type="submit">Update</button>
</form>
@endsection
