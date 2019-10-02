@extends('admin::layouts.admin')

@section('page')

    <ul data-toggle="ajax-tab" class="nav nav-tabs" role="tablist">
        <li>
            <a  role="presentation" class="active" href="{{route('admin.clients.show.general_info_tab', [ 'user' => $client->id ])}}" data-target="#tab-details">
                General Details
            </a>
        </li>

        <li>
            <a  role="presentation" class="active" href="{{route('admin.clients.show.products', [ 'user' => $client->id ])}}" data-target="#tab-products">
                Products
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade" id="tab-details"></div>
        <div role="tabpanel" class="tab-pane fade" id="tab-products"></div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>
@endpush
