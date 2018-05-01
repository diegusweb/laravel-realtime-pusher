@extends('layouts.admin')

@section('content')
    <customer-order-detail :order-id="{{ json_encode($orderId) }}"> </customer-order-detail>
@endsection
