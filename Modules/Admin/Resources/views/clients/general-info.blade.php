<div class="tab-content">

    {!! Form::model($client , ['route' => ['admin.clients.update', $client ] , 'method' => 'post', 'class'=> 'general-form dashed-row white', 'id' => 'detail-client-form'])!!}

    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> General Info </h4>
        </div>

        <div class="panel-body">
            <div class="form-group row">
                {!! Form::label('first_name', __('admin::admin.First Name') , ['class' => 'col-sm-4' ]) !!}

                <div class="col-sm-8">
                    {!! Form::text('first_name' , null , ['class' => 'form-control', 'placeholder' => __('admin::admin.First Name'), 'data-rule-required' => '1' ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('last_name', __('admin::admin.Last Name') , ['class' => 'col-sm-4' ]) !!}

                <div class="col-sm-8">
                    {!! Form::text('last_name' , null , ['class' => 'form-control','placeholder' => __('admin::admin.Last Name'), 'data-rule-required' => '1'])   !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('company_name', __('admin::admin.Company Name') , ['class' => 'col-sm-4' ]) !!}

                <div class="col-sm-8">
                    {!! Form::text('company_name' , null , ['class' => 'form-control','placeholder' => __('admin::admin.Company Name'), 'data-rule-required' => '1'])   !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('phone', __('admin::admin.Phone') , ['class' => 'col-sm-4' ]) !!}

                <div class="col-sm-8">
                    {!! Form::text('phone' , null, ['class' => 'form-control','placeholder' => __('admin::admin.Phone'), 'data-rule-required' => '1','data-rule-digits' => '1'])   !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('address', __('admin::admin.Address') , ['class' => 'col-sm-4' ]) !!}

                <div class="col-sm-8">
                    {!! Form::text('address' , null , ['class' => 'form-control','placeholder' => __('admin::admin.Address'), 'data-rule-required' => '1'])   !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('city', __('admin::admin.City') , ['class' => 'col-sm-4' ]) !!}

                <div class="col-sm-8">
                    {!! Form::text('city' , null , ['class' => 'form-control','placeholder' => __('admin::admin.City'), 'data-rule-required' => '1'])   !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('website', __('admin::admin.Website') , ['class' => 'col-sm-4' ]) !!}

                <div class="col-sm-8">
                    {!! Form::text('website' , null , ['class' => 'form-control','placeholder' => __('admin::admin.Website'), 'data-rule-required' => '1', 'data-rule-url'=>'1'])   !!}
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-check-circle mr5"></span>Save</button>
        </div>
    </div>

    {!! Form::close() !!}

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#detail-client-form').appForm({
            isModal : false,
            onSuccess : function (result) {
                if(result.success){
                    appAlert.success("Saved Successfully", {duration:3000});
                }else{
                    appAlert.error("Something Went Wrong", {duration:3000});
                }
            },
            onError : function (result) {
                appAlert.error("Something Went Wrong", {duration:3000});
            }
        });

        setSelect2('.select2',{})
    });
</script>
