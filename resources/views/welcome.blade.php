@extends('layouts.app')

@section('content')
    <div class="bg-light bg-gradient">
    <div class="container ">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('dishes.index') }}"><img src="{{ asset('images/Meal-No-Background.png') }}" class=" img-fluid mw-1 mh-1" alt="..."><p class="carousel-caption">заказать еду</p></a>

            </div>
            <div class="col-3 mt-5">
                <p class="h1 ">Заказать еду</p>
            </div>
            <div class="col-3 mb-5">

                <a href="{{ route('drinks.index') }}"><img src="{{ asset('images/502726.png') }}" class="img-fluid mw-1 mh-1 " alt="..."></a>

            </div>
            <div class="col-3 mt-5">
                <p class="h1 ">Заказать напиток</p>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <a href="{{ route('dishes.index') }}"><img src="{{ asset('images/145455.png') }}" class="d-block w-100" alt="..."></a>

                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <a href="{{ route('dishes.index') }}"><img src="{{ asset('images/159317.png') }}" class="d-block w-100" alt="..."></a>

                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>


    </div>
    </div>

@endsection

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     var elementCount = 0;
        //
        //     // Add element on button click
        //     $("#add-element").click(function() {
        //         var newElement = $("<div>", { class: "added-element" });
        //         newElement.html("Element " + (++elementCount) + " <button class='remove-element'>Remove</button>");
        //
        //         $("#container").append(newElement);
        //     });
        //
        //     // Remove element on remove button click
        //     $(document).on("click", ".remove-element", function() {
        //         console.log($(this).parent(".added-element").html())
        //         // $(this).parent(".added-element").remove();
        //     });
        // });
    </script>
@endpush
