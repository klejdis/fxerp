{!! Form::open(['route' => ['admin.clients.store' ], 'method' => 'post', 'class'=> 'general-form', 'id' => 'create-clients-form']) !!}

<div class="modal-body">

    <div class="form-group row">
        {!! Form::label('first_name', __('admin::admin.First Name') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('first_name' , '' , ['class' => 'form-control', 'placeholder' => __('admin::admin.First Name'), 'data-rule-required' => '1' ]) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('last_name', __('admin::admin.Last Name') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('last_name' , '' , ['class' => 'form-control','placeholder' => __('admin::admin.Last Name'), 'data-rule-required' => '1'])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('company_name', __('admin::admin.Company Name') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('company_name' , '' , ['class' => 'form-control','placeholder' => __('admin::admin.Company Name'), 'data-rule-required' => '1'])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('phone', __('admin::admin.Phone') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('phone' , '' , ['class' => 'form-control','placeholder' => __('admin::admin.Phone'), 'data-rule-required' => '1','data-rule-digits' => '1'])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('address', __('admin::admin.Address') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('address' , '' , ['class' => 'form-control','placeholder' => __('admin::admin.Address'), 'data-rule-required' => '1'])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('city', __('admin::admin.City') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('city' , '' , ['class' => 'form-control','placeholder' => __('admin::admin.City'), 'data-rule-required' => '1'])   !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('website', __('admin::admin.Website') , ['class' => 'col-sm-4' ]) !!}

        <div class="col-sm-8">
            {!! Form::text('website' , '' , ['class' => 'form-control','placeholder' => __('admin::admin.Website'), 'data-rule-required' => '1', 'data-rule-url'=>'1'])   !!}
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
        $('#create-clients-form').appForm({
            onSuccess : function (result) {
                if(result.success){
                    $('#users').appTable({
                        newData : result.newData
                    });
                }else{

                }
            },
            onError : function (result){
                console.log('error');
                return true;
            }
        });


        setSelect2('.select2',{
        })

    });
</script>
