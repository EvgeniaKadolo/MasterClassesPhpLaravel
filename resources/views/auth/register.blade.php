@extends('layouts.layout')

@section('title', 'Регистрация')

@section('main')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="row--small">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <h2>Форма регистрации</h2>
            <div class="form-group">
                <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                           name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name"
                           autofocus>

                    @error('first_name')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Фамилия') }}</label>

                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                           name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                    @error('last_name')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Телефон') }}</label>

                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control @error('phone') is-invalid @enderror"
                           name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                    @error('phone')
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
                           name="password" required autocomplete="new-password">

                    @error('password')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-end">{{ __('Подтвердите пароль') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group">
                <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Фото') }}</label>

                <div class="col-md-6">
                    <input id="photo" type="file" accept="image/jpg"
                           class="form-control @error('photo') is-invalid @enderror" name="photo"
                           value="{{ old('photo') }}" required autocomplete="photo" autofocus>

                    @error('photo')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="master" class="col-md-4 col-form-label text-md-end" style="display:inline; width: 100px;">{{ __('Ведущий') }}</label>

                <input id="master" type="checkbox" value="1" name="master" autocomplete="photo" autofocus style="display:inline; width: 15px;">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Зарегистрироваться') }}
                </button>
            </div>
        </form>
    </div>
@endsection
