@extends('index')
@section('title', $pageTitle ?? 'Shows Product')
@section('content')
@include('Viewer.Components.productComponent.ProductDetailCard.index', ['productData' => $productData]  )
@endsection
