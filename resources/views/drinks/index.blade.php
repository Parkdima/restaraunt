@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ route('drinks.create') }}">
                <button class="btn btn-dark">добавить</button>
            </a>



            @foreach($drinks as $drink)
                <div class="col-3 mt-3">
                    <a href="{{ route('drinks.edit', $drink) }}">
                        <button class="btn btn-dark">изменить</button>
                    </a>

                    {{--                <img class="card-img-top" src="{{ asset('storage/files/'.$dish->image) }}" alt="Card image cap">--}}

                    {{--                    <h5 class="card-title">{{ $dish->name }}</h5>--}}
                    {{--                    <p class="card-text">{{ $dish->cost }}</p>--}}
                    <div class="row">
                        <div class="col-xs-18 col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="{{ asset('storage/files/'.$drink->image) }}" width="320" height="300">
                                <div class="caption">
                                    <h4>{{ $drink->name }}</h4>
                                    {{--                                        <p>{{ $dish->description }}</p>--}}
                                    <p><strong>Стоимость </strong> {{ $drink->cost }} сом</p>

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-warning cart" data-id="{!! $drink->id !!}" data-sum="{{ $drink->cost }}" >Add to cart</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            Подробнее
                        </button>

                    </div><!-- End row -->
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{!! $drink->name !!}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{$drink->description}}</p>
                                    @foreach($ingredients as $ingredient)
                                        <p>{{ $ingredient->name }}</p>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    {{--                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Удалить {{ route('dishes.delete') }}</button>--}}
                                    <button class="btn btn-success" data-id="{!! $drink->id !!}">add to cart </button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach

        </div>


        {{--            <a href=""  class="btn btn-success add-to-cart" data-id="{{ $dish->id }}">add to cart</a>--}}
        {{--            <a href=""  class="btn btn-success remove-from-cart" data-id="{{ $dish->id }}">remove from cart</a>--}}
    </div>

@endsection



@push('scripts')
    <script>
        $(document).ready(function () {
            // startSession();
            // getTotalQuantity();
        });

        function startSession() {
            if (!sessionStorage.getItem('cart')) {
                let cart = {};
                let total = {
                    quantity: 0,
                    sum: 0
                };
                sessionStorage.setItem('cart', JSON.stringify(cart));
                sessionStorage.setItem('total', JSON.stringify(total));
            }
        }

        $('.cart').click(function () {
            const id = $(this).data('id');
            const sum = $(this).data('sum');
            console.log(sum)
            if (!sessionStorage.getItem('cart')) {
                sessionStorage.setItem('cart', JSON.stringify({
                    products:[],
                    totalQuantity: 0,
                    totalSum: 0
                }));
            }

            let cart = JSON.parse(sessionStorage.getItem('cart'));
            const index = cart.products.findIndex(item => item.id === id);
            if(index !== -1){
                cart.products[index].quantity += 1;
            } else {
                const newProduct = {id:id, quantity: 1};
                cart.products.push(newProduct);
            }
            cart.totalSum += sum;
            cart.totalQuantity += 1;
            sessionStorage.setItem('cart', JSON.stringify(cart));
            // let image = $('#image-' + id).data('image');
            // let name = $('#name-' + id).data('name');
            // let cost = $('#cost-' + id).data('cost');
            //
            // item = {
            //     id: id,
            //     name: name,
            //     image: image,
            //     cost: cost,
            //     quantity: 1,
            // }
            //
            // let cart = JSON.parse(sessionStorage.getItem('cart'));
            // let total = JSON.parse(sessionStorage.getItem('total'));
            //
            // if (typeof cart !== "undefined" && cart.hasOwnProperty(item.id)) {
            //     cart[item.id].quantity += item.quantity;
            //     total['quantity'] += item.quantity;
            // } else {
            //     cart[item.id] = item;
            //     total['quantity'] += 1;
            // }
            // sessionStorage.setItem('cart', JSON.stringify(cart));
            // sessionStorage.setItem('total', JSON.stringify(total));
            // getTotalQuantity();


        });

        function getTotalQuantity() {
            let total = JSON.parse(sessionStorage.getItem('total'));
            $('#cart').html(`<div id="cart">${total.quantity}</div>`);
        }


    </script>

@endpush
