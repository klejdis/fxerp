@extends('admin::layouts.admin')

@section('page')
    <ul data-toggle="ajax-tab" class="nav nav-tabs" role="tablist">
        <li>
            <a  role="presentation" class="active" href="{{route('admin.products.show.general_info_tab', [ 'product' => $product->id ])}}"
                data-target="#tab-details"> General Details </a>
        </li>


    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade" id="tab-details"></div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {


    });
</script>
@endpush
