@extends('layouts.frontend.main')
@section('title', 'Clientes')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="title-content text-center">
            <h6 class="sub-title">
                <strong>
                </strong>
            </h6>
            <h3 class="title-big">Clientes</h3>
        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">
                <div class="table-responsive">
                    <table id="the-table" class="table table-hover table-alternate">
                        <thead>
                        <tr>
                            <th>ID Cliente</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Creada</th>
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

    let customers_list = null;

    $(document).ready(function(){

        customers_list = $('#the-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `{{ route('customers.list') }}`,
                method: 'get'
            },
            order: [[1, 'asc']],
            columns: [
                {data: 'id', name: 'users.id'},
                {data: 'name', name: 'users.name'},
                {data: 'email', name: 'users.email'},
                {data: 'created_at', name: 'users.created_at'},
                { data: 'action', name: 'action', cssClass: 'text-right', orderable: false, searchable: false }
            ],
        });



    });


</script>

@endpush
