@extends('layouts.app')

{{--@section('title', 'Cart')--}}

@section('content')

    <table id="cart" class="table table-hover table-condensed">
        <thead>
        @foreach($dishes as $dish)
        <tr>
            <th style="width:50%"></th>
            <th style="width:10%">Цена</th>
            <th style="width:8%">Количество</th>
            <th style="width:22%" class="text-center">стоимость</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
{{--        <tr>--}}
{{--            <td data-th="Product">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-3 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>--}}
{{--                    <div class="col-sm-9">--}}
{{--                        <h4 class="nomargin">{{$dish->name}}</h4>--}}
{{--                        <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--            <td data-th="Price">$1.99</td>--}}
{{--            <td data-th="Quantity">--}}
{{--                <input type="number" class="form-control text-center" value="1">--}}
{{--            </td>--}}
{{--            <td data-th="Subtotal" class="text-center">1.99</td>--}}
{{--            <td class="actions" data-th="">--}}
{{--                <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>--}}
{{--                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>--}}
{{--            </td>--}}
{{--        </tr>--}}

        </tbody>
        @endforeach
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total 1.99</strong></td>
        </tr>
        <tr>
            <td><a href="{{ route('dishes.index') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
        </tr>
        </tfoot>
    </table>

@endsection
@push('scripts')

    <script>
        let dishes = '@json($dishes)';

        $(document).ready(function(){

            let allDishes = JSON.parse(dishes);
            let storageDishes = [];
            if(sessionStorage.getItem('cart')){
                storageDishes = JSON.parse(sessionStorage.getItem('cart')).products ?? [];
            }
            console.log(allDishes);
            storageDishes.forEach(function (element){

                let index = allDishes.findIndex(item => item.id === element.id);
                let name = allDishes[index].name;
                let price = allDishes[index].cost;
                let image = allDishes[index].image;
                let quantity = element.quantity;
                let description = allDishes[index].description;
                let dish = `<tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="storage/files/${image}" data-th="image"alt="..." class="img-fluid"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">${name}</h4>
                                <p>${description}</p>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price" id="price">${price}</td>
                    <td data-th="Quantity">
                        <input type="number" class="form-control text-center change-btn quantity" data-sum="cost"value="${quantity}">
                    </td>
                    <td data-th="Subtotal " class="text-center">${quantity*price}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm rm-btn" data-id="${element.id}"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>`;
                $('tbody').append(dish);
            });

        });
        $(".update-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update-cart') }}',
                method: 'PATCH',
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });


        $(document).on('click', '.rm-btn',function (e) {
            const id = $(this).data('id');

            let cart = JSON.parse(sessionStorage.getItem('cart'));
            let index = cart.products.findIndex(item => item.id === id);
            cart.products = cart.products.splice(1, index);
            sessionStorage.setItem('cart', JSON.stringify(cart));

            $(this).closest('tr').first().remove();

        });

        $(document).on('change','.quantity', function (e) {
            const id = $(this).data('cost');
            subTotal = cost*quantity;



        });




    </script>

@endpush
