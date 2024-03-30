<!--[if !IE]> -->
<script src="{{ asset('assets/js/jquery-2.1.4.min.js')}}"></script>

<!-- <![endif]-->

<!--[if IE]>
 <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
 <![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
</script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

<!-- page specific plugin scripts -->
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.maskedinput.min.js')}}"></script>
<script src="{{ asset('assets/js/chosen.jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js ')}}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/js/bootbox.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-tag.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-multiselect.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-typeahead.js')}}"></script>
<script src="{{ asset('assets/js/lodash.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/pdf_print.js') }}"></script>

<!--[if lte IE 8]>
  <script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="{{ asset('assets/js/jquery-ui.custom.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>

<!-- ace scripts -->
<script src="{{ asset('assets/js/ace-elements.min.js')}}"></script>
<script src="{{ asset('assets/js/ace.min.js')}}"></script>

@stack('scripts')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
    jQuery(function($) {
        $(document).ready(function(){
            $('.date_birth').datepicker({
                autoclose: true,
                todayHighlight: true
            })
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function(){
                $(this).prev().focus();
            });
            // $('.input-mask-date').mask('99/99/9999');
        })

        $('.time_picker').timepicker({
            minuteStep: 1,
            showSeconds: false,
            showMeridian: true,
            disableFocus: true,
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down'
            }
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        $('.chosen-select').chosen({allow_single_deselect:true,width: "100%"});

        $('.date_mask').mask('99-99-9999');
        $('.age_mask').mask('99');
        $('.phone_mask').mask('255999999999');


        $('.file-input').ace_file_input({
            no_file:'No Image ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:true //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });

        $('.file-review').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small',//large | fit
            whitelist:'gif|png|jpg|jpeg|pdf',
        });

        var myTable =
        $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable( {
            bAutoWidth: false,
            "aoColumns": [
              { "bSortable": false },
              null, null,null, null, null,
              { "bSortable": false }
            ]
        } );
    })
</script>
