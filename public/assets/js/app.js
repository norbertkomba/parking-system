
/*
 * CSRF token Setup
 */
$.ajaxSetup
    ({
        headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
function base_url(){
    let pathparts = location.pathname.split('/');
    let url = "";
    if (location.host === 'localhost' || location.host === '127.0.0.1')
        url = location.origin+'/'+pathparts[1].trim('/')+'/';
    else url = location.origin+'/';
    return url;
}

$('.hit-enter-log').on("keydown", function (event) {
    if(event.keyCode === 13 || event.keyCode === 9) {
        // var username = $('.user-name').val();
        // var password = $('.user-password').val();
        // var data = 'username='+username+'&password='+password;
        // $('.authenticate').prop('disabled',true).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i> Processing..');
        // $('.notify').html('<b class="ace-icon fa fa-refresh fa-spin blue"> </b> <i  style="color: black;">Authenticating please wait ...</i>');
        // $.ajax({
        //     //this is the php file that processes the data
        //     url: base_url()+'login-save',
        //     //GET method is used
        //     type: "POST",
        //     //pass the data
        //     data: data,
        //     //Do not cache the page
        //     cache: false,
        //     //success
        //     success: function (v) {
        //         if(v === 200) {
        //             // $('.notify').html("<i style='color: green'>Authentication success, Redirecting ... ("+v+")</i>");
        //             swal({
        //                 text: 'Authentication success, Redirecting ... ('+v+')',
        //                 icon: "success",
        //                 button: "OK",
        //             }).then(()=>{
        //                 window.location.href = base_url()+'dashboard';
        //             });
        //         }
        //         $('.notify').html("");$('.authenticate').prop('disabled',false).html("Login <span class='fa fa-arrow-right'></span>");
        //     },
        //     error: function(jqXhr, textStatus, errorThrown){
        //         getAllErrors(jqXhr, textStatus, errorThrown);
        //         $('.notify').html("");$('.authenticate').prop('disabled',false).html("Login <span class='fa fa-arrow-right'></span>");
        //     }
        // });
        login_process();
    }
});

$('.authenticate').click(function () {
    // var username = $('.user-name').val();
    // var password = $('.user-password').val();
    // var data = 'username='+username+'&password='+password;
    // $('.authenticate').prop('disabled',true).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i> Processing..');
    // $('.notify').html('<b class="ace-icon fa fa-refresh fa-spin blue"> </b> <i  style="color: black;">Authenticating please wait ...</i>');
    // $.ajax({
    //     //this is the php file that processes the data
    //     url: base_url()+'login-save',
    //     //GET method is used
    //     type: "POST",
    //     //pass the data
    //     data: data,
    //     //Do not cache the page
    //     cache: false,
    //     //success
    //     success: function (v) {
    //         if(v === 200) {
    //             swal({
    //                 text: 'Authentication success, Redirecting ... ('+v+')',
    //                 icon: "success",
    //                 button: "OK",
    //             }).then(()=>{
    //                 window.location.href = base_url()+'dashboard';
    //             });
    //         }
    //         $('.notify').html(" ");$('.authenticate').prop('disabled',false).html("Login <span class='fa fa-arrow-right'></span>");
    //         // else $('.notify').html("<i style='color: red'>"+v+"</i>");
    //     },
    //     error: function(jqXhr, textStatus, errorThrown ){
    //         getAllErrors(jqXhr, textStatus, errorThrown);
    //         $('.notify').html("");$('.authenticate').prop('disabled',false).html("Login <span class='fa fa-arrow-right'></span>");
    //     }
    // });
    login_process();
});

function login_process() {
    var username = $('.user-name').val();
    var password = $('.user-password').val();
    var data = 'username='+username+'&password='+password;
    $('.authenticate').prop('disabled',true).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i> Processing..');
    $('.notify').html('<b class="ace-icon fa fa-refresh fa-spin blue"> </b> <i  style="color: black;">Authenticating please wait ...</i>');
    $.ajax({
        //this is the php file that processes the data
        url: base_url()+'login-process',
        //GET method is used
        type: "POST",
        //pass the data
        data: data,
        //Do not cache the page
        cache: false,
        //success
        success: function (v) {
            if(v === 200) {
                // $('.notify').html("<i style='color: green'>Authentication success, Redirecting ... ("+v+")</i>");
                swal({
                    text: 'Authentication success, Redirecting ... ('+v+')',
                    icon: "success",
                    button: "OK",
                }).then(()=>{
                    window.location.href = base_url()+'dashboard';
                });
            }
            $('.notify').html("");$('.authenticate').prop('disabled',false).html("Login <span class='fa fa-arrow-right'></span>");
        },
        error: function(jqXhr, textStatus, errorThrown){
            getAllErrors(jqXhr, textStatus, errorThrown);
            $('.notify').html("");$('.authenticate').prop('disabled',false).html("Login <span class='fa fa-arrow-right'></span>");
        }
    });
}

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "100",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "show",
    "hideMethod": "hide"
};

$('.delete-btn').on('click',function(){
    // $('#delete-modal').modal('show');
    const Id = $(this).data('id').split('|')[1];
    const table = $(this).data('id').split('|')[0];
    swal({
        title: "Delete Confirmation",
        text: "Are you sure you want to remove permanently this data..? \n\n[ " + $(this).data('value') + " ]\n\n Once you remove no way to recover it!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirm) => {
        if (confirm) {
            $.ajax({
                url:'/delete-data/'+table+'/'+Id,
                type:"GET",
                caches:false,
                success:function(data){
                    if(data==200){
                        $('.request-respond').html('<span class="green"><i class="ace-icon fa fa-tick"></i> Data removed successfully</span> ');$('#delete-modal').modal('hide');
                        swal("Congrats!", "Data records removed successfully!", "success").then(() => {window.location.reload()});
                    }
                },error:function(jqXhr, ajaxOptions, errorThrown){
                    $('.request-respond').html('');
                    if (jqXhr.status === 0) toastr.error('* Network error, please check your network connection.','ERROR');
                    else if (jqXhr.status === 422 || jqXhr.status === 500) toastr.error('ERROR',''+jqXhr.statusText+" : "+jqXhr.status+'');
                    else if (jqXhr.status === 419) toastr.error('ERROR',''+jqXhr.statusText+" : "+jqXhr.status+'');
                    else if (jqXhr.status === 403) toastr.error('* Your unauthorized to perform this action, Please contact Admin.','Oops..!!');
                    else toastr.error('ERROR',''+jqXhr.statusText+" : "+jqXhr.status+'');
                    $('#confirm-delete').prop('disabled',false);
                }
            });
        }
    });
});

function getAllErrors(jqXhr, ajaxOptions, errorThrown, button = null) {
    $(button).prop('disabled', false).html('<i class="fa fa-send"></i> Save');
    $('.request-progress').hide();
    $('.loader-spinner').fadeOut();

    if (jqXhr.status === 422) {
        var errorString = '';
        $.each(jqXhr.responseJSON.errors, function(key, value) {
            errorString += '* <span style="font-style:italic">' + value + '</span><br>';
        });
        toastr.error(errorString, 'REQUIRED');
    } else if (jqXhr.status === 0) {
        toastr.error('ERROR', '* Network error, please check your network connection.');
    } else if (jqXhr.status === 500) {
        swal({
            title: jqXhr.statusText +" "+ jqXhr.status,
            text: "There is problem with server side, please fix it !",
            icon: "warning",
            button: "Close",
        });
    } else if (jqXhr.status === 419) {
        toastr.error('ERROR', "Token expired, Reload the page.");
    } else if (jqXhr.status === 403) {
        toastr.error('ERROR', '* You are unauthorized to perform this request.');
    }else if (jqXhr.status === 406) {
        swal({
            title: jqXhr.statusText,
            text: jqXhr.responseJSON.error,
            icon: "error",
            button: "Close",
        });
    } else {
        toastr.error('ERROR', '' + jqXhr.statusText + " : " + jqXhr.status + '');
    }
}

function updateOrCreateData(url_form, button) {
    $('#'+button).prop('disabled',true).html('<i class="ace-icon fa fa-circle-o-notch fa-spin white"></i> Please wait...');
    $.ajax({
        url: base_url() + url_form,
        type: 'POST',
        data: new FormData(document.getElementById(url_form)),
        dataType:'JSON',
        enctype:"multipart/form-data",
        processData:false,
        contentType:false,
        caches:false,
        success: function(response) {
            if (response.status === 200) {
                swal({
                    title: 'Success!',
                    text: response.message,
                    icon: "success",
                    button: "OK",
                }).then(() => { window.location.reload(true); });
            }else if (response.status === 401) {
                swal({
                    title: response.message,
                    icon: "warning",
                    dangerMode: true,
                    button: "Close",
                });
            }
            $('#'+button).prop('disabled',false).html('<i class="fa fa-send"></i> Save');
        },
        error: function(jqXhr, ajaxOptions, errorThrown) {
            getAllErrors(jqXhr, ajaxOptions, errorThrown);
            $('#'+button).prop('disabled',false).html('<i class="fa fa-send"></i> Save');
        }
    });
}

function changePassword(v)
{
    $('.confirm_change_password').on('click',function(){
        $('.request-progress').show().html('<i class="ace-icon fa fa-circle-o-notch fa-spin white"></i> Inserting data please wait...');
        $(this).prop('disabled',true).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i> Processing..');
        $.ajax({
            url:"/user/change-password",
            method:"GET",
            data:{password:$('.ch_password').val(),id:v},
            cache:false,
            success:function(data){
                $('.confirm_change_password').prop('disabled',false).html('<i class="fa fa-send"></i> Save');$('.request-progress').hide("");$('.loader-spinner').fadeOut();
                if (data.status==200) {
                    swal({
                        title: 'Success!',
                        text: data.message,
                        icon: "success",
                        button: "OK",
                    }).then(() => { window.location.reload(true); });
                }else toastr.warning(data,'Oops..!');
            },error:function(jqXhr, ajaxOptions, errorThrown){
                getAllErrors(jqXhr, ajaxOptions, errorThrown,'.confirm_change_password');
            }
        });
    });
}

$(window).on('load', function() {
    $('.pdf_file').click(function() {
        try {
            let id = $(this).attr('id');
            $('.report-head').show();
            $('#printThis'+id).print();
            $('.report-head').hide();
            return false;
        } catch (error) {
            console.error('Error:', error);
        }
    });
});
