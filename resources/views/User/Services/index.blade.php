
@extends('user.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

@include('user.components.services.servicesCard.index',['servicesList' => $ListOfServices])

@endsection
