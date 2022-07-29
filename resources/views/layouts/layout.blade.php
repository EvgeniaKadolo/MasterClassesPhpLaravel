<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
</head>
<body>
<div class="header">
    <div class="row grid middle between">
        <div class="logo">
            <a href="/">
                <img src="{{asset('images/logo.png')}}">
            </a>
        </div>
        <div class="title">
            Клуб любителей творчества «ОчУмелые ручки»
        </div>
        <div class="auth">
            @if(Auth::check())
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="padding:0;">
                    @csrf
                </form>
            @else
                <a href="/login">Вход</a>
            @endif
        </div>
    </div>
</div>
<div class="row row--nogutter">
    <div class="menu-burger">
        <div class="burger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<div class="main">
    <div class="row">
        @yield('main')
    </div>
</div>
<div class="row row--nogutter">
    <div class="line"></div>
</div>
<div class="footer">
    <div class="row">
        <div class="row--small grid between">
            <div class="address">Наш адрес: ВДНХ, 120в</div>
            <div class="tel">Тел: 89123456765</div>
            <div class="copy">(с) Copyright, 2017</div>
        </div>
    </div>
</div>
</body>
</html>

