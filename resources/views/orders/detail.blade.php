@extends('layouts.admin')

@section('content')
    <admin-order-detail :order-id="{{ json_encode($orderId) }}"> </admin-order-detail>
@endsection
