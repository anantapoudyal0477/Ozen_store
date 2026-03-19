
@extends('User.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

@include('User.Components.ProductComponent.ProductCard.index',["productData"=>$products,'key'=>$key ?? null,'EyePowerData'=>$EyePowerData ?? null])

@endsection
