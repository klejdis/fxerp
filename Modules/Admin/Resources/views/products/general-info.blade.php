<div class="tab-content">

    {!! Form::model($product , ['route' => ['admin.products.update', $product ] , 'method' => 'post', 'class'=> 'general-form dashed-row white', 'id' => 'detail-product-form'])!!}

    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> General Info </h4>
        </div>

        <div class="panel-body">

        </div>

        <div class="panel-footer">
            <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-check-circle mr5"></span>Save</button>
        </div>
    </div>

    {!! Form::close() !!}

</div>

<script type="text/javascript">
    $(document).ready(function () {




    });
</script>
