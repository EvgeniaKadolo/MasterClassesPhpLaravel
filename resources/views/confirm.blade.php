@extends('layouts.layout')

@section('title', 'Подтверждение записи')

@section('main')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="row--small">
        <form action="{{ route('subscribe', ['timetable' => $timetable, 'master_class' => $master_class]) }}" method="post">
            @csrf
            <h2>Подтверждение записи</h2>
            <div class="form-group">
                <label>ФИО: {{Auth::user()->last_name}} {{Auth::user()->first_name}}</label>
            </div>
            <div class="form-group">
                <label>Название: {{$master_class->name}}</label>
            </div>
            <div class="form-group">
                <label>Вид творчества: {{$master_class->type()->first()->name}}</label>
            </div>
            <div class="form-group">
                <label>ФИО мастера: {{$master_class->user()->first()->last_name}} {{$master_class->user()->first()->first_name}}</label>
            </div>
            <div class="form-group">
                <label>Количество мест: {{$timetable->number}}</label>
            </div>
            <div class="form-group">
                <label>Цена: {{$master_class->price}} руб.</label>
            </div>
            <div class="form-group">
                <label>Дата: {{$timetable->date}}</label>
            </div>
            <div class="form-group">
                <label>Время: {{$timetable->time()->first()->time}}</label>
            </div>
            <div class="form-group">
                <input type="submit" value="Записаться" class="btn btn-primary">
            </div>
        </form>
        <div class="form-group" style="margin-left: 248px;">
            <a href="/type/{{$master_class->type()->first()->id}}">
                <input type="submit" value="Отменить" class="btn btn-primary">
            </a>
        </div>
    </div>
@endsection
