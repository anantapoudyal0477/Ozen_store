
@extends('user.user-layout-page')

@section('title', $pageTitle ?? 'Premium Eyewear Collection')

@section('content')

@include('user.components.productComponent.productCard.index',["productData"=>$products,'key'=>$key ?? null,'EyePowerData'=>$EyePowerData ?? null])

@endsection
