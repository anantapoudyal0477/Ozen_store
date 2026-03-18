
@extends('user.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

EyeCheckups show
{{ Auth::user()->user_type }}

@endsection
