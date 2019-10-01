{!! Form::open(['route' => ['admin.products.store' ], 'method' => 'post', 'class'=> 'general-form', 'id' => 'create-product-form']) !!}
<div class="modal-body">

    <div class="form-group row">
        {!! Form::label('name', 'Name' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('name' , '' , ['class' => 'form-control' , 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('name', 'Description' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::textarea('description' , '' , ['class' => 'form-control' ])   !!}
        </div>
    </div>


</div>

<div class="modal-footer">
    <div class="row">
        <button class="btn btn-primary pull-right" type="submit"> <i class="fa fa-check-circle mr5"></i>Save</button>
    </div>
</div>

{!! Form::close() !!}

<script type="text/javascript">
    $(document).ready(function () {
        $('#create-product-form').appForm({
            onSuccess : function (result){
                if(result.success){
                    $('#table').appTable({
                        newData : result.newData
                    });
                }else{
                    console.log('error');
                }
            },
            onError : function (result){
                console.log('error');
                return true;
            }
        });

    });
</script>
