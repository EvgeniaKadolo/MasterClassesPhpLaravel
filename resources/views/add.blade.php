@extends('layouts.layout')

@section('title', 'Добавление мастер-класса')

@section('main')
    <div class="row row--nogutter top-line">
        <div class="line"></div>
    </div>
    <div class="row--small">
        <form action="{{ route('store') }}" method="post">
            @csrf

            <h2>Добавление мастер-класса</h2>
            <div class="form-group">
                <select id="master_class_id" name="master_class_id">
                    <option value="-1">Новый</option>
                    @foreach($master_classes as $master_class)
                        <option value="{{$master_class->id}}" @if($master_class->id == old('master_class_id')) selected @endif>{{$master_class->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Название: </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
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
                        <option value="{{$type->id}}" @if($type->id == old('type_id')) selected @endif>{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Описание: </label>
                <input type="text" id="description" name="description" value="{{ old('description') }}">
                @error('description')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Количество мест: </label>
                <input type="text" id="number" name="number" value="{{ old('number') }}">
                @error('number')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Цена: </label>
                <input type="text" id="price" name="price" value="{{ old('price') }}">
                @error('price')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Дата: </label>
                <input type="date" id="date" name="date" value="{{ old('date') }}">
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
                        <option value="{{$time->id}}" @if($time->id == old('time_id')) selected @endif>{{$time->time}}</option>
                    @endforeach
                </select>
                @error('time_id')
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" value="Добавить" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
