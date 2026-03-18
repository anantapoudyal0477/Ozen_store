<!-- resources/views/user/payment/json.blade.php -->
@extends('user.user-layout-page')

@section('title', 'Order JSON')

@section('content')
<h3>Order JSON for Order: {{ $payload['purchase_order_id'] }}</h3>
<pre style="background:#f5f5f5; padding:15px; border:1px solid #ccc;">
{{ json_encode($payload, JSON_PRETTY_PRINT) }}
</pre>
@endsection
