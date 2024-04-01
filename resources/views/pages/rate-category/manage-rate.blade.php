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
                                <th class="text-left">Category</th>
                                <th class="text-left">Rate</th>
                                <th>Status</th>
                                <th class="hidden"></th>
                                <th class="hidden"></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\DB::select("SELECT * FROM `vehicle_rate_view` ORDER BY `id` DESC LIMIT 200") as $key => $r)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ $r->rate }}</td>
                                    <td class="center"><span class="badge badge-{{ $r->status ? 'primary' : 'danger' }}">{{ $r->status ? 'Active' : 'InActive' }}</span></td>
                                    <td class="hidden"></td>
                                    <td class="hidden"></td>

                                    <td class="center" width="100">
                                        <div class="action-buttons">
                                            @can('update rate')
                                                <a class="green" href="{{ route('rate.manage',['rate'=>$r->id]) }}">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                            @endcan

                                            @can('delete rate')
                                                <a class="red delete-btn" style="cursor: pointer;" data-value="{{ $r->rate }}" data-id="vehicle_rates|{{ $r->id }}">
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
                        Rate Details
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <form id="rate-category/rate/cu-rate" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <select name="category" class="chosen-select form-control" data-placeholder="Category">
                                        <option value=""></option>
                                        @foreach (\DB::select('SELECT * FROM `category_exists` WHERE `status` = ?', [1]) as $cat)
                                            <option value="{{ $cat->id }}" {{ (isset($rate->id) && $rate->vehicle_category_id == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="number" class="form-control" name="rate_name" value="{{ $rate->rate ?? '' }}" placeholder="Rate">
                                        <input type="hidden" name="rate" value="{{ $rate->id ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Status" class="bigger-120">
                                        Status: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <label class="flex">
                                        <input name="status" type="radio" class="ace input-lg" value="1" {{ (isset($rate) && $rate->status ? 'checked' : '') }}>
                                        <span class="lbl bigger-100">&nbsp;&nbsp;Active</span>
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="flex">
                                        <input name="status" type="radio" class="ace input-lg" value="0" {{ (isset($rate) && !$rate->status ? 'checked' : '') }}>
                                        <span class="lbl bigger-100">&nbsp;&nbsp;InActive</span>
                                    </label>
                                </div>

                                <button type="button" class="btn btn-sm btn-primary btn-round" id="cu_rate" onclick="updateOrCreateData('rate-category/rate/cu-rate','cu_rate')">
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
