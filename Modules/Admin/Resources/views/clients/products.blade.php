<div class="tab-content">
    <div class="p20">
        <div class="panel panel-default">
            <div class="page-title clearfix">
                <h1>Products</h1>

                <div class="title-button-group">

                </div>
            </div>
            <div class="table-responsive">
                <table id="products" class="display" cellspacing="0" width="100%"></table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {

        $('#products').appTable({
            source :  '{{ route('admin.clients.show.products.datatable',['client'=>$client]) }}',
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
