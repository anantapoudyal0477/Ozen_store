
@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')
this is wishlist page
{{ Auth::user()->user_type }}
@endsection
