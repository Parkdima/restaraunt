@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('$drinks.update', $drink) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="input-name">Название</label>
                    <input class="form-control" id="input-name" type="text" name="name" value="{{ old('name', $drink->name) }}">
                </div>
                <div class="form-group">
                    <label for="input-description">Описание</label>
                    <input class="form-control" id="input-description" type="text" name="description" value="{{ old('description', $drink->description) }}">
                </div>
                <div class="form-group">
                    <label for="input-cost">Цена</label>
                    <input class="form-control" id="input-cost" type="text" name="cost" value="{{ old('cost', $drink->cost) }}">
                </div>
                <button type="submit" class="btn btn-dark mt-3">Сохранить</button>
            </form>
        </div>
    </div>


@endsection


