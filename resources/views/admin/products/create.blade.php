@extends('layouts.frontend.main')
@section('title', 'Nuevo Producto')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="row title-content">
            <div class="col-md-6"><h3 class="title-big">Nuevo Producto
                </h3></div>
            <div class="col-md-6 text-right">
                <a href="{{ route('products.index') }}" class="btn btn-xs btn-secondary p-2"><small>Volver</small></a>
            </div>


        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">
                <div class="col-md-5">
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Categoría</label>
                            <select id="category_id" name="category_id" required class="form-control">
                                @foreach($categories as $id=>$name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <span class="help-feedback text-danger"><small>{{ $errors->first('category_id') }}</small></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                            @if($errors->has('name'))
                                <span class="help-feedback text-danger"><small>{{ $errors->first('name') }}</small></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea rows="3" id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Precio unitario</label>
                            <input type="number" step="any" min="0" id="price" name="price" value="{{ old('price') }}" required class="form-control">
                            @if($errors->has('price'))
                                <span class="help-feedback text-danger"><small>{{ $errors->first('price') }}</small></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Product Image</label><br>
                            <input type="file" id="image" name="image">
                            @if($errors->has('image'))
                                <br><span class="help-feedback text-danger"><small>{{ $errors->first('image') }}</small></span>
                            @endif
                        </div>
                        <br>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary p-2">Crear</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
