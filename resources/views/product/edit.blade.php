@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать продукт</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data"
                      class="w-50">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <input type="text" name="title" class="form-control"
                               value="{{ $product->title ?? old('title') }}" placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" class="form-control"
                               value="{{ $product->description ?? old('description') }}" placeholder="Описание">
                    </div>
                    <div class="form-group">
                        <textarea name="content" cols="30" rows="10" class="form-control"
                                  placeholder="Контент">{{ $product->content ?? old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="number" name="price" class="form-control"
                               value="{{ $product->price ?? old('price') }}" placeholder="Цена">
                    </div>
                    <div class="form-group">
                        <input type="number" name="old_price" class="form-control"
                               value="{{ $product->old_price ?? old('old_price') }}" placeholder="Старая цена">
                    </div>
                    <div class="form-group">
                        <input type="number" name="count" class="form-control"
                               value="{{ $product->count ?? old('count') }}" placeholder="Количество на складе">
                    </div>
                    <div class="form-group">
                        <img src="{{ asset($product->imageUrl) }}" class="w-100" alt="">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex">
                        @foreach($product->productImages as $productImage)
                            <div style="width: 33.3%">
                                <img src="{{ $productImage->imageUrl }}" width="100%" alt="">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[]" type="file" class="custom-file-input"
                                       id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[]" type="file" class="custom-file-input"
                                       id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[]" type="file" class="custom-file-input"
                                       id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ $category->id === $product->category->id ? 'selected' : ''}}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="group_id" class="form-control select2" style="width: 100%;">
                            <option disabled selected>Выберите группу</option>
                            @foreach($groups as $group)
                                <option
                                    value="{{ $group->id }}" {{ $group->id === ($product->group ? $product->group->id : null) ? 'selected' : ''}}>{{ $group->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Выберите тег"
                                style="width: 100%;">
                            @foreach($tags as $tag)
                                <option
                                    value="{{ $tag->id }}" {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="colors[]" class="colors" multiple="multiple" data-placeholder="Выберите цвет"
                                style="width: 100%;">
                            @foreach($colors as $color)
                                <option
                                    value="{{ $color->id }}" {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $color->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Редактировать">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
