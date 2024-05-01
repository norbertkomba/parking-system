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
                    Results for "Latest Registered {{ str_replace('-',' ',Str::title(request()->segment(1))) }}"
                </div>
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="text-left">Registration No</th>
                                <th width="190" class="text-left">Owner Name</th>
                                <th width="190" class="text-left">Owner Phone</th>
                                <th class="text-left">Card No</th>
                                <th class="text-right">Card Balance</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\DB::select("SELECT * FROM `vehicle_list` ORDER BY `id` DESC LIMIT 200") as $key => $v)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $v->reg_no }}</td>
                                    <td>{{ $v->owner_name }}</td>
                                    <td>{{ $v->owner_contact }}</td>
                                    <td>{{ $v->card_no ?? "Unknown" }}</td>
                                    <td class="text-right">{{ number_format($v->card_fee,2) }}/=</td>

                                    <td class="center" width="120">
                                        <div class="action-buttons">
                                            @can('update vehicle')
                                                <a class="green" href="{{ route('vehicle.manage',['vehicle'=>$v->id]) }}">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a class="blue" style="cursor: pointer" data-target="#recharge-card-modal" data-toggle="modal" onclick="RechargeCardAmount({{ $v->id }})">
                                                    <i class="ace-icon fa fa-refresh bigger-130"></i>
                                                </a>
                                            @endcan

                                            @can('delete vehicle')
                                                <a class="red delete-btn" style="cursor: pointer;" data-value="{{ $v->reg_no }}" data-id="vehicles|{{ $v->id }}">
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
                        Vehicle Details
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <form id="vehicle/cu-vehicle" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <select name="category" class="chosen-select form-control" data-placeholder="Select category">
                                        <option value=""></option>
                                        @foreach (\DB::select('SELECT * FROM `vehicle_categories` WHERE `status` = ?', [1]) as $cat)
                                            <option value="{{ $cat->id }}" {{ (isset($vehicle->id) && $vehicle->vehicle_category_id == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select name="card" class="chosen-select form-control" data-placeholder="Select card">
                                        <option value=""></option>
                                        @foreach (\DB::select('SELECT * FROM `card_exists`') as $card)
                                            <option value="{{ $card->id }}" {{ (isset($vehicle->id) && $vehicle->vehicle_card_id == $card->id) ? 'selected' : '' }}>{{ $card->card_no }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="vehicle_name" value="{{ $vehicle->vehicle_name ?? '' }}" placeholder="Vehicle name">
                                        <input type="hidden" name="vehicle" value="{{ $vehicle->id ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-ticket"></i></span>
                                        <input type="number" class="form-control" name="card_fee" value="{{ $vehicle->card_fee ?? '' }}" placeholder="Card Amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control text-uppercase" name="reg_no" value="{{ $vehicle->reg_no ?? '' }}" placeholder="Plate/Registration number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="owner_name" value="{{ $vehicle->owner_name ?? '' }}" placeholder="Owner name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" name="owner_contact" value="{{ $vehicle->owner_contact ?? '' }}" placeholder="Owner contact">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-primary btn-round" id="cu-vehicle" onclick="updateOrCreateData('vehicle/cu-vehicle','cu-vehicle')">
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
