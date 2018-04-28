@extends('layouts.admin')

@section('content')
    <promotions :logged="{{ json_encode(auth()->check()) }}"></promotions>
@endsection