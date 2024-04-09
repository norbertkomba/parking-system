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
            <div class="col-sm-12">
                <div class="table-header">
                    Results for "Latest Registered Group"
                </div>

                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th class="text-left">Group Name</th>
                                <th class="text-left">Guard Name</th>
                                <th class="center">No Of Permission</th>
                                <th>
                                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                    Created at
                                </th>
                                <th>
                                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                    Updated at
                                </th>
                                <th width="100"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\Spatie\Permission\Models\Role::get() as $key => $role)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td class="bolder">{{ Str::title($role->name) }}</td>
                                    <td class="bolder">{{ Str::title($role->guard_name) }}</td>
                                    <td class="center"><span class="badge badge-danger">{{ count($role->permissions) }}</span></td>
                                    <td class="center">{{ $role->created_at->format('d/m/Y') }}</td>
                                    <td class="center">{{ $role->updated_at->format('d/m/Y') }}</td>
                                    <td width="100" class="center">
                                        <div class="action-buttons">
                                            @can('update group')
                                                <span class="tooltip-success" data-rel="tooltip" data-placement="top" title="edit-role">
                                                    <a class="green" href="{{ route('role.manage',['role' => $role->id]) }}">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                                                    </a>
                                                </span>
                                            @endcan

                                            @can('delete group')
                                                <span class="tooltip-error" data-rel="tooltip" data-placement="top" title="delete-role">
                                                    <a class="red delete-role" href="#delete-role">
                                                        <i class="ace-icon fa fa-trash-o bigger-150"></i>
                                                    </a>
                                                </span>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div>
        </div>
    </div>

@endsection


