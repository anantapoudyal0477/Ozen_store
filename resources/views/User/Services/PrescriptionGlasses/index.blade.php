@extends('user.user-layout-page')

@section('title', $pageTitle ?? 'Prescription Glasses')

@section('content')

{{-- Add New Button --}}
<div class="mb-4 flex justify-end">
    <form action="{{route('User.services.PrescriptionGlasses.create')}}" method="GET">
        <button id="openAddModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Prescription
        </button>
    </form>
</div>

{{-- Prescription Table --}}
<table class="w-full border-collapse text-sm">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="py-2 px-3">#</th>
            <th class="py-2 px-3">Left Eye (SPH/CYL/AXIS)</th>
            <th class="py-2 px-3">Right Eye (SPH/CYL/AXIS)</th>
            <th class="py-2 px-3">PD</th>
            <th class="py-2 px-3">Created At</th>
            <th class="py-2 px-3 text-right">Actions</th>
        </tr>
    </thead>
   <tbody>
@foreach($prescriptions as $prescription)

@php
    $left = $prescription->eyes->where('eye', 'left')->first();
    $right = $prescription->eyes->where('eye', 'right')->first();
@endphp

<tr class="border-b">
    <td class="py-2 px-3">{{ $loop->iteration }}</td>

    <td class="py-2 px-3">
        {{ $left?->sphere ?? '-' }} /
        {{ $left?->cylinder ?? '-' }} /
        {{ $left?->axis ?? '-' }}
    </td>

    <td class="py-2 px-3">
        {{ $right?->sphere ?? '-' }} /
        {{ $right?->cylinder ?? '-' }} /
        {{ $right?->axis ?? '-' }}
    </td>

    <td class="py-2 px-3">{{ $prescription->pd ?? '-' }}</td>

    <td class="py-2 px-3">
        {{ $prescription->created_at->format('Y-m-d') }}
    </td>

    <td class="py-2 px-3 text-right">
        <form action="{{ route('User.services.PrescriptionGlasses.destroy', $prescription->id) }}"
              method="POST"
              onsubmit="return confirm('Delete this prescription?')">
            @csrf
            @method('DELETE')
            <button class="text-red-600 hover:underline">Delete</button>
        </form>
    </td>
</tr>

@endforeach
</tbody>

</table>
@endsection
