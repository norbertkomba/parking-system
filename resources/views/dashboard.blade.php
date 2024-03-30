
@extends('temp.app')
@section('title','Dashboard')
@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Home</a>
            </li>
            <li class="active">Dashboard</li>
        </ul>
    </div>

    <div class="page-content">
        @include('temp.ace-setting')
        <div class="row">
            <div class="col-xs-12">

                <div class="alert alert-block alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-check green"></i>

                    Welcome back {{ Auth::user()->full_name }} to,
                    <strong class="green">
                        {{ config('app.name') }}
                        <small>(v1.0)</small>
                    </strong>
                </div>

                {{-- <div class="row">
                    <div class="col-xs-12">
                        <div class="infobox infobox-green">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-users"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"></span><div class="space-6"></div>
                                <div class="infobox-content">Staff</div>
                            </div>
                        </div>

                        <div class="infobox infobox-red">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-users"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"></span><div class="space-6"></div>
                                <div class="infobox-content">Patients</div>
                            </div>
                        </div>

                        <div class="infobox infobox-green">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-user-md"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"></span><div class="space-6"></div>
                                <div class="infobox-content">Doctors</div>
                            </div>
                        </div>

                        <div class="infobox infobox-pink">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-user-secret"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"></span><div class="space-6"></div>
                                <div class="infobox-content">Users</div>
                            </div>
                        </div>
                        <div class="space-6"></div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
