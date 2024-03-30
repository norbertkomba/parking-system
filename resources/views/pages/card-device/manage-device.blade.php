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
                                <th class="text-left">Device ID</th>
                                <th class="text-left">Device Name</th>
                                <th class="text-left">Card Limit</th>
                                <th class="hidden"></th>
                                <th class="hidden"></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\DB::select("SELECT * FROM `devices` ORDER BY `id` DESC LIMIT 100") as $key => $card)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $card->device_no }}</td>
                                    <td>{{ $card->device_name }}</td>
                                    <td>{{ $card->card_limit ?? 0 }}</td>
                                    <td class="hidden"></td>
                                    <td class="hidden"></td>

                                    <td class="center" width="100">
                                        <div class="action-buttons">
                                            @can('update device')
                                                <a class="green" href="{{ route('device.manage',['device'=>$card->id]) }}">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                            @endcan

                                            @can('delete device')
                                                <a class="red delete-btn" style="cursor: pointer;" data-value="{{ $card->device_name }}" data-id="devices|{{ $card->id }}">
                                                    <i class="ace-icon fa fa-trash-o bigger-140"></i>
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="widget-box widget-color-blue">
                    <div class="table-header">
                        Device Details
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <form id="card-device/device/cu-device" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="device_name" value="{{ $device->device_name ?? '' }}" placeholder="Device name">
                                        <input type="hidden" name="device" value="{{ $device->id ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control" name="card_limit" value="{{ $device->card_limit ?? '' }}" placeholder="Card limit">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-primary btn-round" id="cu_device" onclick="updateOrCreateData('card-device/device/cu-device','cu_device')">
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
