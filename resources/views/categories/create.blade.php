@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('categories.store') }}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="input-name">Название категории</label>
                    <input id="input-name" class="form-control" type="text" name="name">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
