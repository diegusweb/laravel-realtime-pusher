@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-check-square-o"></i> Formulario de promociones</h3>
                    Añade y actualiza promociones desde aquí
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ $route }}" novalidate>
                        @csrf
                        @include('admin.promotions.form')
                    </form>

                </div>
            </div><!-- end card-->
        </div>

    </div>
@endsection
