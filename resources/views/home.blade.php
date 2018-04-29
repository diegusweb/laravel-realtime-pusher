@extends('layouts.admin')

@section('content')

    @auth
        <cart :user_id="{{ json_encode(auth()->id()) }}"></cart>
    @endauth

    <promotions :logged="{{ json_encode(auth()->check()) }}"></promotions>
    <products :logged="{{ json_encode(auth()->check()) }}"></products>

@endsection