@extends('layouts.frontend.main')
@section('title', 'Categorías')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="row title-content">
            <div class="col-md-6"><h3 class="title-big">Categorías
                </h3></div>
            <div class="col-md-6 text-right">
                <a href="{{ route('categories.create') }}" class="btn btn-xs btn-success p-2"><small>Nueva Categoría</small></a>
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
                            <th style="width:100px">ID</th>
                            <th>Nombre</th>
                            <th></th>
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

    let categories_list = null;

    $(document).ready(function(){
        //DataTables jQuery Javascript library.
        categories_list = $('#the-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `{{ route('categories.list') }}`,
                //método del controlador
                method: 'get'
            },
            order: [[0, 'desc']],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                { data: 'action',
                name: 'action', 
                cssClass: 'text-right',
                orderable: false,
                searchable: false }
            ],
        });



    });


</script>

@endpush
