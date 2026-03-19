
@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

@include('User.Components.Services.ServicesCard.index',['servicesList' => $ListOfServices])

@endsection
