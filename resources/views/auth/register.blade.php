@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-10 offset-1 pt-4 pb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fa fa-check-square-o"></i> {{ __("Darme de alta") }}</h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="/register" novalidate>
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
                            <label for="username">{{ __("Nombre de usuario (*)") }}</label>
                            <input
                                class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                id="username"
                                name="username"
                                placeholder="{{ __("Nombre de usuario") }}"
                                value="{{ old('username') }}"
                            />
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __("Contraseña (*)") }}</label>
                            <input
                                type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                id="password"
                                placeholder="{{ __("Contraseña") }}"
                                name="password"
                            />
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __("Confirma la Contraseña (*)") }}</label>
                            <input
                                type="password"
                                class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                id="password_confirmation"
                                placeholder="{{ __("Confirma la Contraseña") }}"
                                name="password_confirmation"
                            />
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __("Registrarme") }}</button>
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