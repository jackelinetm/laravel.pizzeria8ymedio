@extends('layouts.frontend.main')
@section('title', 'Pedidos')
@section('content')

    <div class="container py-md-5">
        <br>
        <br>
        <div class="title-content">
            <h6 class="sub-title">
                <strong>
                </strong>
            </h6>
            <h3 class="title-big">Pedidos</h3>
        </div>
        <div class="pt-lg-5 pt-4">
            <div class="row menu-body">
                <div class="table-responsive">
                    <table id="orders-table" class="table table-hover table-alternate">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Pedido#</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
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

    let orders_list = null;

    $(document).ready(function(){

        orders_list = $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `{{ route('admin.orders.list') }}`,
                method: 'get'
            },
            order: [[0, 'desc']],
            columns: [
                {data: 'created_at', name: 'orders.created_at'},
                {data: 'id', name: 'orders.id'},
                {data: 'name', name: 'users.name'},
                {data: 'amount', name: 'orders.amount', className: 'text-right',},
                {
                    data: 'status',
                    name: 'orders.status',
                    className: 'text-center',
                    //orderable: false,
                   // searchable: false
                },
                { data: 'action', name: 'action', cssClass: 'text-right', orderable: false, searchable: false }
            ],
        });



    });


</script>

@endpush
