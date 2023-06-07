@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('drinks.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="input-name">Название напитка</label>
                    <input id="input-name" class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="input-cost">Цена</label>
                    <input id="input-cost" class="form-control" type="number" name="cost">
                </div>
                <div class="form-group">
                    <label for="input-image">Картинка напитка</label>
                    <input id="input-image" class="form-control" type="file" name="image">
                </div>
                <div class="form-group">
                    <label for="input-image">Категория напитка</label>
                    <select name="category_id" class="form-control" id="">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="consist" id="consist-id">
                    <div class="row consistent-container">
                        <div class="col-4">
                            <label for="input-image">Ингредиенты</label>
                            <select name="ingredient_ids[]" class="form-control" id="">
                                <option value="">выберите состав</option>
                                @foreach($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="input-image">Количество</label>
                                <input id="input-image" class="form-control" type="text" name="counts[]">
                            </div>
                        </div>
                        <div class="d-flex col-1 align-items-center justify-content-center">
                            <button type="button" class="btn btn-danger p mt-2 delete-row">+</button>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary mt-4" id="add-row">Добавить</button>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')

    <script>

        $('#add-row').click(function (e) {

            let consist = $(".consistent-container").first().clone();
            consist.find("input[type='text']").val("");
            $('#consist-id').append(consist);

        })
        $(document).on('click', '.delete-row', function (e) {
            if($('#consist-id').children().length>1){
                $(this).closest('.consistent-container')[0].remove();
            }else {
                alert('Last element')
            }
        })
    </script>

@endpush
