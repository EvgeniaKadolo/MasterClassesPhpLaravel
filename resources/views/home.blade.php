@extends('layouts.layout')

@section('title', 'Личный кабинет')

@section('main')
    <div class="hover"></div>
    <div class="title"></div>
    <div class="row--small grid between">
        <div class="content driver-page">
            <div class="driver-page-photo">
                <img src="{{asset('storage/'.Auth::user()->photo)}}" style="height:180px;">
            </div>
            <div class="driver-page-name">{{Auth::user()->last_name}} {{Auth::user()->first_name}}</div>
            <div class="driver-page-text">
                <div class="driver-page-my">Мои мастер-классы</div>
                <div style="margin-bottom: 20px">
                    @if (session('success'))
                        <div class="driver grid">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <table class="driver-page-table">
                    <tbody>
                    @can('master')
                        @foreach($master_classes as $master_class)
                            @foreach($master_class->timetables as $timetable)
                                <tr>
                                    <td>{{$timetable->date}} {{$timetable->time->time}}</td>
                                    <td>
                                        <b>{{$master_class->name}}</b>
                                        <div>
                                            <form action="{{route('delete', $timetable)}}" method="post" style="margin-top:-30px;padding:0;display:inline-block; width:70px">
                                                @method('DELETE')
                                                @csrf
                                                <input class="driver-page-btn btn" type="submit" value="Удалить" style="padding: 3px 8px;">
                                            </form>
                                            <a href="/change/{{$timetable->id}}">
                                                <input class="driver-page-btn btn" type="submit" value="Редактировать" style="padding: 3px 8px;">
                                            </a>
                                        </div>
                                        @foreach ($timetable->users as $user)
                                            <p>
                                                {{$user->last_name}} {{$user->first_name}}<br>
                                                email: {{$user->email}} <br>
                                                tel: {{$user->phone}}
                                            </p>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        @foreach($master_classes as $master_class)
                            <tr>
                                <td>{{$master_class->date}} {{$master_class->time->time}}</td>
                                <td>
                                    <b>{{$master_class->master_class->name}}</b>
                                    <p>
                                        цена: {{$master_class->master_class->price}} р.<br>
                                    <form action="{{route('unsubscribe', ['timetable' => $master_class])}}"
                                          method="post" style="margin-top:-30px;padding:0;display:inline-block;">
                                        @csrf
                                        <input class="driver-page-btn btn" type="submit" value="Отписаться">
                                    </form>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    @endcan
                    </tbody>
                </table>
            </div>
            @can('master')
                <div class="driver-page-btn-wrapper">
                    <a href="/add">
                        <input class="driver-page-btn btn" type="submit" value="Добавить мастер-класс">
                    </a>
                </div>
            @endcan
        </div>
        <ul class="menu">
            <li><a href="/">Главная</a></li>
            <li><a href="/home">Личный кабинет</a></li>
            @foreach ($types as $type)
                <li><a href="/type/{{$type->id}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
