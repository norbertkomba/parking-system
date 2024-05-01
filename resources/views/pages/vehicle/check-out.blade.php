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
            <div class="col-sm-12">
                <div class="table-header">
                    Results for "Latest Registered {{ str_replace('-',' ',Str::title(request()->segment(1))) }}"
                </div>
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="text-left">Vehicle No</th>
                                <th class="text-left">Owner Name</th>
                                <th class="text-left">Owner Phone</th>
                                <th class="text-left">Card No</th>
                                <th>Time Exceed x Rate = Charge</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\DB::select("SELECT * FROM `vehicle_process_list` WHERE `status` = ? ORDER BY `id` DESC LIMIT 300",[1]) as $key => $v)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $v->reg_no }}</td>
                                    <td>{{ $v->owner_name }}</td>
                                    <td>{{ $v->owner_contact }}</td>
                                    <td>{{ $v->card_no ?? "Unknown" }}</td>
                                    <td width="200" class="center">
                                        @php
                                            $time_in = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $v->time_in);
                                            $time_out = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $v->time_out);
                                            $time_diff_hours = $time_out->diffInHours($time_in);
                                        @endphp
                                        <span class="badge badge-primary">{{ $time_diff_hours."hr" }}&nbsp; x &nbsp;{{ number_format($v->rate) }}&nbsp;</span>&nbsp;&nbsp; = &nbsp;&nbsp;<span class="badge badge-danger">{{ number_format($v->fee_charge) }}</span>
                                    </td>

                                    <td class="center" width="100">
                                        <div class="action-buttons">
                                            @can('update vehicle')
                                                <a class="btn btn-minier btn-round btn-primary" onclick="getVehicleDetails({{ $v->id }})">
                                                    View Details
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
        </div>
    </div>
@endsection
