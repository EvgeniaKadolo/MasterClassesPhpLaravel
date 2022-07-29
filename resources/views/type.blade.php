@extends('layouts.layout')

@section('title', $type->name)

@section('main')
    <div class="hover"></div>
    <div class="title">{{$type->name}}</div>
    <div class="row--small grid between">
        <div class="content">
            <img src="{{asset('images/elifant.png')}}">
            <p>{{$type->description}}</p>
        </div>
        <ul class="menu">
            <li><a href="/">Главная</a></li>
            <li><a href="/home">Личный кабинет</a></li>
            @foreach ($types as $type)
                <li><a href="/type/{{$type->id}}">{{$type->name}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row shedule">
        <div class="row--small">
            <h2>Расписание</h2>
            <div class="drivers">
                @if (session('success'))
                    <div class="driver grid">
                        {{ session('success') }}
                    </div>
                @endif
                @foreach($master_classes as $master_class)
                    <div class="driver grid">
                        <div class="driver-left grid">
                            <div class="driver-photo">
                                <img src="{{asset('storage/'.$master_class->user()->first()->photo)}}"
                                     style="width:200px;">
                            </div>
                            <div class="driver-text" style="width: 550px">
                                <div
                                    class="driver-name">{{$master_class->user()->first()->last_name}} {{$master_class->user()->first()->first_name}}</div>
                                <div class="driver-desc">
                                    {{$master_class->description}}
                                </div>
                            </div>
                        </div>
                        @can(['master'])
                            <div class="driver-right" style="width:160px">
                                <form action="{{route('delete_master_class', $master_class)}}" method="post"
                                      style="margin:0;width:160px">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="Удалить" class="driver-btn">
                                </form>
                            </div>
                        @else
                            <div class="driver-right" style="width:160px">
                                @foreach($master_class->timetables as $timetable)
                                    <div class="driver-time">
                                        <a href="/confirm/{{$timetable->id}}}">
                                            <input type="submit" value="Записаться" class="driver-btn">
                                        </a>
                                    </div>
                                    <div class="driver-time">{{$timetable->date}} {{$timetable->time->time}}</div>
                                @endforeach
                            </div>
                        @endcan
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
