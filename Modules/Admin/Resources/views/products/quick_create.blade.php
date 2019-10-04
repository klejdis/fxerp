{!! Form::open(['route' => ['admin.products.store' ], 'method' => 'post', 'class'=> 'general-form', 'id' => 'create-product-form']) !!}
<div class="modal-body">

    <div class="form-group row">
        {!! Form::label('name', 'Name' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('name' , '' , ['class' => 'form-control' , 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('unit', 'Unit' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('unit' , '' , ['class' => 'form-control' , 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('unit_price', 'Unit Price' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('unit_price' , '' , ['class' => 'form-control' , 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('purchase_price', 'Purchase Price' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('purchase_price' , '' , ['class' => 'form-control' , 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('client_id', 'Client' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::select('client_id' , $clients , '' , ['class' => 'form-control', 'placeholder' => '', 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('product_category_id', 'Product Category' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::select('product_category_id' , $productCategories , '' , ['class' => 'form-control', 'placeholder' => '', 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('product_brand_id', 'Product Brand ' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::select('product_brand_id' , $productBrands , '' , ['class' => 'form-control', 'placeholder' => '', 'data-rule-required' => 1 ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('name', 'Description' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::textarea('description' , '' , ['class' => 'form-control' ])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('freeshipping', 'Free Shipping' , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::checkbox('freeshipping' , '1' , ['class' => 'form-control' , 'data-rule-required' => 1 ])   !!}
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
