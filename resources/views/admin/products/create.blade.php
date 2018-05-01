@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-check-square-o"></i> Formulario de productos</h3>
                    Añade y actualiza productos desde aquí
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ $route }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @include('admin.products.form')
                    </form>
                </div>
            </div><!-- end card-->
        </div>

    </div>
@endsection
