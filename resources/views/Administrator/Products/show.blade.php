@extends('Administrator.admin-layout-page')
@section('title',$pageTitle??"exe")
@section('content')
@include('Administrator.components.productComponent.productDetailCard.index')
@endsection
