@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="{!! asset('storage/files/'.$dish->image) !!}" alt="" class="img-fluid">
            </div>
            <div class="col-3">
                <p>{!! $dish->name !!}</p>
                <p>{!! $dish->cost !!}</p>
                <p>{!! $dish->category->name !!}</p>


                @foreach($dish->ingredients as $ingredient)

                    <p>{{ $ingredient->name }}
                        <span>({{ $ingredient->unit->name }})</span>
                        <span> - {{ $ingredient->pivot->value }}</span>

                    </p>
                @endforeach
            </div>



@endsection
