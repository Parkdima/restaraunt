

@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('categories.create') }}">
        <button class="btn btn-dark">добавить</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cats as $cat)
            <tr>
                <th scope="row">{!! $cat->id !!}</th>
                <td>{!! $cat->name !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection
