@extends('temp.app')
@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ url('dashboard') }}">Home</a>
            </li>
            <li>{{ str_replace('-',' ',Str::title(request()->segment(1))) }}</li>
            <li class="active">{{ str_replace('-',' ',Str::title(request()->segment(2))) }}</li>
        </ul>
    </div>

    <div class="page-content">
        @include('temp.ace-setting')
        <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                <div class="table-header">
                    Results for "Latest Registered {{ Str::title(request()->segment(2)) }}"

                    @can('create users')
                        <a href="#new-user" role="button" data-toggle="modal" data-target="#add-user" class="pull-right bolder" style="margin-right: 2%;color: white;">
                            <span class="fa fa-user-plus"></span> Add User
                        </a>
                    @endcan

                </div>
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th class="text-left">Full Name</th>
                                <th class="text-left">Username</th>
                                <th class="hidden"></th>
                                <th class="hidden"></th>
                                <th class="hidden"></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\App\Models\User::get() as $key => $u)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td><a href="{{ route('user.manage',['user'=>$u->id]) }}">{{ $u->full_name }}</a></td>
                                    <td>{{ $u->username }}</td>
                                    <td class="hidden"></td>
                                    <td class="hidden"></td>
                                    <td class="hidden"></td>

                                    <td width="150" class="center">
                                        <div class="action-buttons">
                                            @can('update user')
                                                <a class="green" href="{{ route('user.manage',['user'=>$u->id]) }}">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-140"></i>
                                                </a>
                                            @endcan

                                            @can('change status')
                                                <a class="blue" style="cursor: pointer;" data-target="#change-password-modal" data-toggle="modal" onclick="changePassword({{ $u->id }})">
                                                    <i class="ace-icon fa fa-refresh bigger-140"></i>
                                                </a>

                                                <a class="red status-btn" style="cursor: pointer;" data-value="{{ $u->full_name }}" data-id="users|{{ $u->id }}|status|{{ (($u->status) ? 0 : 1) }}">
                                                    <i class="ace-icon fa fa-{{ (($u->status) ? 'unlock' : 'lock') }} bigger-140"></i>
                                                </a>
                                            @endcan


                                            @can('delete user')
                                                <a class="red delete-btn" style="cursor: pointer;" data-value="{{ $u->full_name }}" data-id="users|{{ $u->id }}">
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
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <div class="widget-box widget-color-blue">
                    <div class="table-header">
                        User Details
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <form id="logs-access/cu-user" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="full_name" value="{{ $user->full_name ?? '' }}" placeholder="Full name">
                                        <input type="hidden" name="user" value="{{ $user->id ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="username" value="{{ $user->username ?? '' }}" placeholder="Username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <select name="role" class="chosen-select form-control" data-placeholder="Select user role">
                                            <option value=""></option>
                                            @foreach (\Spatie\Permission\Models\Role::get() as $t)
                                                <option value="{{ $t->id }}" {{ (isset($user->id) && in_array($t->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '') }}>{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if (!$user)
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                            <input type="password" class="form-control" name="co_password" placeholder="Re-Password">
                                        </div>
                                    </div>
                                @endif

                                <button type="button" class="btn btn-sm btn-primary btn-round" id="cu_user" onclick="updateOrCreateData('logs-access/cu-user','cu_user')">
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
