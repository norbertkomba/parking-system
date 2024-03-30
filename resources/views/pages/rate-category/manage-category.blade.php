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
                                <th class="hidden"></th>
                                <th class="hidden"></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\DB::select("SELECT * FROM `vehicle_categories` ORDER BY `id` DESC LIMIT 200") as $key => $cat)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td class="center"><span class="badge badge-{{ $cat->status ? 'primary' : 'danger' }}">{{ $cat->status ? 'Active' : 'InActive' }}</span></td>
                                    <td class="hidden"></td>
                                    <td class="hidden"></td>
                                    <td class="hidden"></td>

                                    <td class="center" width="100">
                                        <div class="action-buttons">
                                            @can('update category')
                                                <a class="green" href="{{ route('category.manage',['category'=>$cat->id]) }}">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                            @endcan

                                            @can('delete category')
                                                <a class="red delete-btn" style="cursor: pointer;" data-value="{{ $cat->name }}" data-id="vehicle_categories|{{ $cat->id }}">
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
                        Category Details
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <form id="rate-category/category/cu-category" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="name" value="{{ $category->name ?? '' }}" placeholder="Category name">
                                        <input type="hidden" name="category" value="{{ $category->id ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Status" class="bigger-120">
                                        Status: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <label class="flex">
                                        <input name="status" type="radio" class="ace input-lg" value="1" {{ (isset($category) && $category->status ? 'checked' : '') }}>
                                        <span class="lbl bigger-100">&nbsp;&nbsp;Active</span>
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="flex">
                                        <input name="status" type="radio" class="ace input-lg" value="0" {{ (isset($category) && !$category->status ? 'checked' : '') }}>
                                        <span class="lbl bigger-100">&nbsp;&nbsp;InActive</span>
                                    </label>
                                </div>

                                <button type="button" class="btn btn-sm btn-primary btn-round" id="cu_category" onclick="updateOrCreateData('rate-category/category/cu-category','cu_category')">
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
