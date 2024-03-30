<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('temp.css')
	</head>
	<body style="background-color: white;">
		<div class="container-fluid">
            <div class="row-fluid">
                <div class="center alert alert-success alert-block">
                    <h1 class="text-uppercase"><strong>Welcome Parking Fee Collection System</strong></h1>
                </div>
                <div class="col-sm-offset-4 col-md-offset-4 col-md-4 col-sm-4" id="login_box">
                    <h2 style="margin-top: 1px;margin-bottom: -15px;">
                        <img src="" style="width: 130px;padding:11px">
                    </h2>
                    <hr style="margin-bottom: 10px">
                    <div class="form-horizontal" id="contact_form">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="ace-icon fa fa-user"></i></span>
                                        <input name="username" placeholder="Username" class="form-control user-name" type="text" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="ace-icon fa fa-key"></i></span>
                                        <input name="password" placeholder="Password" class="form-control user-password hit-enter-log" type="password" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a style="padding-left: 15px;" href="">Forgot your password?</a>
                                <div class="col-md-12">
                                    <i class="notify" style="padding-left: 15px;"></i>
                                    <button type="button" class="authenticate btn btn-sm btn-default pull-right btn-round">Login <span class="fa fa-arrow-right"></span></button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
		</div>

		<div id="versionBar">
			<div class="copyright" style="font-size:13px;font-family:Helvetica, sans-serif;"><span class="bolder blue">{{ config('app.name') }}</span>  &copy; {{ date('Y') }}&comma;&nbsp;All rights reserved.</div>
			<!-- // copyright-->
		</div>
		@include('temp.js')
	</body>
</html>




