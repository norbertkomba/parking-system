<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
        @include('temp.css')
        <style>
            .t-dec {
                text-decoration: none;
            }
        </style>
	</head>

	<body class="no-skin" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
		@include('temp.header')
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('temp.sidebar')
			<div class="main-content">
				<div class="main-content-inner">
					@yield('content')
                    @include('temp.modals')
				</div>
			</div>
            @include('temp.footer')
		</div>

		<!-- basic scripts -->
        @include('temp.js')
	</body>
</html>
