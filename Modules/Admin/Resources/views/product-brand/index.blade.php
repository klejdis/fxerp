@extends("admin::layouts.admin")

@section('page')
    <div class="p20">
        <div class="panel panel-default">
            <div class="page-title clearfix">
                <h1>{{ $panel['name'] }}</h1>

                <div class="title-button-group">
                    {!! modal_anchor(route('admin.products-brand.quick_create') ,__('admin::admin.Create Brand') , ['class' => 'btn btn-default']) !!}
                </div>
            </div>
            <div class="table-responsive">
                <table id="table" class="display" cellspacing="0" width="100%"></table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $('#table').appTable({
                source :  '{{ route('admin.products-brand.datatable') }}',
                columns : [
                    {  title : 'Id' , data : 'id'},
                    {  title : 'Name' , data : 'name' },
                    {  title : 'Description' , data : 'description' },
                    {  title : 'Created At' , data : 'created_at' },
                    {  data : 'actions', title: '<i class="fa fa-bars"></i>', "class": "text-left option w250" , orderable: false, searchable: false },
                ],
            });

        });
    </script>
@endpush
