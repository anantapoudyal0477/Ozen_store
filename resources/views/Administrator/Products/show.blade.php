@extends('administrator.admin-layout-page')
@section('title',$pageTitle??"exe")
@section('content')
@include('administrator.components.productComponent.productDetailCard.index')
@endsection
