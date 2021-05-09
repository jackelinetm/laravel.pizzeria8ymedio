@extends('layouts.frontend.main')
@section('title', 'Nueva Categoría')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="row title-content">
            <div class="col-md-6"><h3 class="title-big">Nueva Categoría
                </h3></div>
            <div class="col-md-6 text-right">
                <a href="{{ route('categories.index') }}" class="btn btn-xs btn-secondary p-2"><small>Volver</small></a>
            </div>


        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">
                <div class="col-md-4">
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}" class="form-control">
                            @if($errors->has('name'))
                                <span class="help-feedback text-danger"><small>{{ $errors->first('name') }}</small></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary p-2">Crear</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
