@extends('layouts.layout')

@section('title')
    Авторизация
@endsection

@section('main')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="row--small">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h2>Форма авторизации</h2>
            <div class="form-group">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password">

                    @error('password')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Войти') }}
                    </button>
                    <a href="/register">
                        <input type="button" value="Регистрация" class="btn btn-primary" style="width:115px; height:38px;">
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
