@extends('layouts.layout')

@section('title', 'Редактирование мастер-класса')

@section('main')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="row--small">
        <form action="{{ route('edit', $timetable->id) }}" method="post">
            @csrf

            <h2>Редактирование мастер-класса</h2>
            <div class="form-group">
                <label>Название: </label>
                <input type="text" id="name" name="name" value="{{$master_class->name}}">
                @error('name')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Вид творчества: </label>
                <select id="type_id" name="type_id">
                    @foreach($types as $type)
                        <option value="{{$type->id}}" @if($type->id == $master_class->type()->first()->id) selected @endif>{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Описание: </label>
                <input type="text" id="description" name="description" value="{{$master_class->description}}">
                @error('description')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Количество мест: </label>
                <input type="text" id="number" name="number" value="{{$timetable->number}}">
                @error('number')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Цена: </label>
                <input type="text" id="price" name="price" value="{{$master_class->price}}">
                @error('price')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Дата: </label>
                <input type="date" id="date" name="date" value="{{$timetable->date}}">
                @error('date')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Время: </label>
                <select id="time_id" name="time_id">
                    @foreach($times as $time)
                        <option
                            value="{{$time->id}}" @if($time->id == $timetable->time()->first()->id) selected @endif>{{$time->time}}</option>
                    @endforeach
                </select>
                @error('time_id')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" value="Изменить" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
