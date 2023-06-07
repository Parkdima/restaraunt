@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('dishes.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="input-name">Название блюда</label>
                    <input id="input-name" class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="input-cost">Цена</label>
                    <input id="input-cost" class="form-control" type="number" name="cost">
                </div>
                <div class="form-group">
                    <label for="input-description">Описание блюда</label>
                    <input id="input-description" class="form-control" type="text" name="description">
                </div>
                <div class="form-group">
                    <label for="input-image">Картинка блюда</label>
                    <input id="input-image" class="form-control" type="file" name="image">
                </div>
                <div class="form-group">
                    <label for="input-image">Категория блюда</label>
                    <select name="category_id" class="form-control" id="">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="consist" >
                    <div class="row consistent-container" id="consist-id">
                        <div class="col-5">
                            <label for="input-image">Ингредиенты</label>
                            <select name="ingredient_ids[]" class="form-control" id="">
                                <option value="">выберите состав</option>
                                @foreach($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="input-image">Количество</label>
                                <input id="input-image" class="form-control" type="text" name="counts[]">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary mt-4" id="add-row">Добавить</button>
                </div>

                <button type="submit" class="btn btn-success mt-3">Сохранить</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        let count = 0;
        $('#add-row').click(function (e) {
            let consist =
                "<div class='row consistent_added' id='consist'>" +
                    "<div class='col-5'>"  +
                        "<label for='input-image'>Ингредиенты</label>" +
                            "<select name='ingredient_ids[]' class='form-control' id=''> " +
                                "<option value=''>выберите состав</option> "+
                                    @foreach($ingredients as $ingredient)
                                        "<option value='{{ $ingredient->id }}'>{{ $ingredient->name }}</option>"+
                                    @endforeach
                             "</select>"+
                    "</div>"+
                    "<div class='col-5>"+
                        "<div class='form-group'>"+
                           "<label for='input-image'>Количество</label>"+
                            "<input id='input-image' class='form-control' type='text' name='counts[]'>"+
                        "</div>"+
                "<div class='col-2 mt-3'>" +
                    "<button type='button' class='btn btn-danger p mt-2 delete-row'>x</button>" +
                "</div>"+
                    "</div>"+
                "</div>";

            $('#consist-id').after(consist);

        })
        $(document).on('click', '.delete-row', function (e) {
            $(this).parent().parent('.consistent_added').remove();
        })
    </script>

@endpush
