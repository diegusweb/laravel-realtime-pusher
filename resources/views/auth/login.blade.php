@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="pt-4 pb-3 col-10 offset-1">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-check-square-o"></i> {{ __("Iniciar sesión") }}</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="/login" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __("Correo electrónico (*)") }}</label>
                            <input
                                type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                id="email"
                                name="email"
                                placeholder="{{ __("Correo electrónico") }}"
                                value="{{ old('email') }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __("Contraseña (*)") }}</label>
                            <input
                                type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                id="password"
                                name="password"
                                placeholder="{{ __("Contraseña") }}"
                                required
                            />
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __("Acceder") }}</button>
                    </form>

                </div>
            </div><!-- end card-->
        </div>

        <div class="col-md-5 pt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection