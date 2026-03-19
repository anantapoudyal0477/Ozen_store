
@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

individual product page
{{ Auth::user()->user_type }}

@endsection
