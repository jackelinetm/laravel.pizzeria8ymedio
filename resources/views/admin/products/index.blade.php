@extends('layouts.frontend.main')
@section('title', 'Productos')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="row title-content">
            <div class="col-md-6"><h3 class="title-big">Productos</h3></div>
            <div class="col-md-6 text-right">
                <a href="{{ route('products.create') }}" class="btn btn-xs btn-success p-2"><small>Producto Nuevo</small></a>
            </div>

        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">
                <div class="table-responsive">
                    @if(session()->has('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif
                    <table id="the-table" class="table table-hover table-alternate">
                        <thead>
                        <tr>
                            <th style="width:100px">Imagen</th>
                            <th>Categoría</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th style="width:120px;"></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">

    let products_list = null;

    $(document).ready(function(){
        products_list = $('#the-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `{{ route('products.list') }}`,
                method: 'get'
            },
            order: [[1, 'asc'],[2, 'asc']],
            columns: [
                {data: 'image', name: 'products.image'},
                {data: 'category', name: 'categories.name'},
                {data: 'name', name: 'products.name'},
                {data: 'description', name: 'products.description'},
                {data: 'price', name: 'products.price', className: 'text-right',},
                { data: 'action', name: 'action', cssClass: 'text-right', orderable: false, searchable: false }
            ],
        });
    });
</script>

@endpush
