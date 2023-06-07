@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('categories.update', $category) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="input-name">Название</label>
                    <input class="form-control" id="input-name" type="text" name="name" value="{{ old('name', $category->name) }}">
                </div>
                <button type="submit" class="btn btn-dark mt-3">Сохранить</button>
            </form>
        </div>
    </div>


@endsection
