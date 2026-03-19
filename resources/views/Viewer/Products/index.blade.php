@extends('index')

@section('title', e($pageTitle ?? 'Products'))

@section('content')
<!-- <div>
    @include('Viewer.Components.Messages.Error_Messages')
</div>
<div>
    @include('Viewer.Components.Messages.Success_Messages')
</div> -->

    <!-- Hero Section -->
    <div>
        @include('Viewer.Components.ProductComponent.ProductionHero.index')
    </div>

    <div>
        @if(!empty($productData) && count($productData) > 0)
            @include('Viewer.Components.ProductComponent.ProductCard.index', [
                'productData' => $productData
            ])
        @else
            <p class="text-center text-red-600 font-semibold">No products available.</p>
        @endif
    </div>

@endsection
