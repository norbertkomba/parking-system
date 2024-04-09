@extends('temp.app')
@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ url('dashboard') }}">Home</a>
        </li>
        <li>
            <a>{{ str_replace('-',' ',Str::title(request()->segment(1))) }}</a>
        </li>
        <li class="active">{{ str_replace('-',' ',Str::title(request()->segment(2))) }}</li>
    </ul>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">User Role Details</h4>
                </div>
                <form id="logs-access/cu-user-role">
                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">User role name:</span>
                                    <input type="text" name="group" class="form-control" value="{{ $role->name ?? '' }}" placeholder="Name">
                                    <input type="hidden" name="role" value="{{ $role->id ?? '' }}">
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                @php DB::statement("SET SQL_MODE=''"); @endphp
                                @foreach (DB::select('SELECT * FROM permissions GROUP BY group_name') as $g)
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="widget-box">
                                            <div class="widget-header">
                                                <h4 class="widget-title bolder text-capitalize">{{ $g->group_name }}</h4>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main padding-2">
                                                    @foreach (DB::select('SELECT * FROM permissions WHERE group_name = ?',[$g->group_name]) as $p)
                                                        <label>
                                                            <input name="permission[]" class="ace input-lg center" type="checkbox" value="{{ $p->id ?? '' }}" {{ (isset($role) && $role->permissions->pluck('name')->contains($p->name) ? 'checked' : '') }}/>
                                                            <span class="lbl bigger-120"></span> {{ $p->name }}
                                                        </label><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-primary btn-round" id="cu_group" onclick="updateOrCreateData('logs-access/cu-user-role','cu_group')">
                        <i class="fa fa-send"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



