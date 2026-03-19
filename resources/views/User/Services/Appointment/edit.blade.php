
@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

EyeCheckups edit
{{ Auth::user()->user_type }}

@endsection
