@extends('temp.app')
@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ url('dashboard') }}">Home</a>
            </li>

            <li>
                <a>{{ str_replace('-',' & ',Str::title(request()->segment(1))) }}</a>
            </li>
            <li class="active">{{ str_replace('-',' ',Str::title(request()->segment(2))) }}</li>
        </ul>
    </div>

    <div class="page-content">
        @include('temp.ace-setting')
        <div class="row">
            <div class="col-sm-7">
                <div class="table-header">
                    Results for "Latest Registered {{ str_replace('-',' ',Str::title(request()->segment(2))) }}"
                </div>
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="text-left">Name</th>
                                <th>Status</th>
                                <th class="hidden"></th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- @foreach (\App\Models\Unit::all() as $key => $v)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td class="center"><span class="badge badge-{{ ($v->status) ? 'primary' : 'danger' }}">{{ $v->status ? 'Active' : 'Blocked' }}</span></td>
                                    <td class="hidden"></td>
                                    <td class="center">{{ $v->created_at->format('d-M, Y') }}</td>
                                    <td class="center">{{ $v->updated_at->format('d-M, Y') }}</td>

                                    <td class="center" width="100">
                                        <div class="action-buttons">
                                            @can('update si-unit')
                                                <a class="green" href="{{ route('si-unit.edit',['id'=>base64_encode($v->id)]) }}">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                            @endcan
                                            @can('change status')
                                                <a class="red status-btn" data-value="{{ $v->name }}" data-id="units|{{ $v->id }}|status|{{ ($v->status) ? 0 : 1 }}">
                                                    <i class="ace-icon fa fa-{{ ($v->status) ? 'unlock' : 'lock' }}  bigger-150"></i>
                                                </a>
                                            @endcan
                                            @can('delete si-unit')
                                                <a class="red delete-btn" style="cursor: pointer;" data-value="{{ $v->name }}" data-id="units|{{ $v->id }}">
                                                    <i class="ace-icon fa fa-trash-o bigger-140"></i>
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="widget-box widget-color-blue">
                    <div class="table-header">
                        Card Details
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <form id="hospital-settings/units/createForm" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <select name="device" class="chosen-select form-control" data-placeholder="Choose Device" onchange="CheckDevice(this)">
                                        <option value=""></option>
                                        @foreach (\DB::select('SELECT * FROM `devices`') as $device)
                                            <option value="{{ $device->id }}" {{ (isset($card->id) && $card->device_id == $device->id) ? 'selected' : '' }}>{{ $device->device_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group card_na hidden">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="name" value="{{ $unit->name ?? '' }}" placeholder="Card name">
                                        <input type="hidden" name="unit_id" value="{{ $unit->id ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group card_fe hidden">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="name" value="{{ $unit->name ?? '' }}" placeholder="Card fee">
                                    </div>
                                </div>

                                <div class="form-group card_no hidden">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="name" value="{{ $unit->name ?? '' }}" placeholder="Card number">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-primary btn-round" id="cu_units" onclick="create_update_data(0,'hospital-settings/units','cu_units')">
                                    <i class="fa fa-send"></i> Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function CheckDevice(v) {
            $('.card_na, .card_fe, .card_no').(v.value !== '') ? removeClass('hidden') : addClass('hidden');

            // (v.value !== '') ?
            // if (v.value !== '') {
            //     $('.card_na, .card_fe, .card_no').removeClass('hidden');
            // }else{
            //     $('.card_na, .card_fe, .card_no').addClass('hidden');
            // }
        }


    </script>
@endpush
