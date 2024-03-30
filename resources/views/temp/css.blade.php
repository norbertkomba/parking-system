<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title>{{ config('app.name') }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="overview &amp; stats" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
<link rel="icon" type="image/png" sizes="96x96" href="">
<!-- page specific plugin styles -->
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-duallistbox.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/nor-tech.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/css/ace-log.css') }}"/>

<!-- ace styles -->
<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />

<!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
<![endif]-->
<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css')}}" />

<!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="{{ asset('assets/js/ace-extra.min.js')}}"></script>

<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
<!--[if lte IE 8]>
<script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
<script src="{{ asset('assets/js/respond.min.js') }}"></script>
<![endif]-->

<style>
    .cus-dropdown{
        position: absolute;
        display: block;
        width: 90%;
        max-height: 380px;
        overflow-y: scroll;
        margin-left: 12px;
    }

    .cus-dropdown-a{
        position: absolute;
        display: block;
        width: 100%;
        max-height: 380px;
        overflow-y: scroll;
    }


    .t-dec {
        text-decoration: none;
    }

    .table-fixed thead th {
        position: sticky;
        top: 0;
    }

    .table-fixed tr th {
        position: sticky;
        top: 0;
    }

    .table-fixed th {
        position: sticky;
        top: 0;
    }
    .logo_img{
        margin-top: 10px;
        margin-left: 15px;
        margin-bottom: 10px;
    }
    .logo_img img{
        height: 100px;
    }
    .patient-img img{
        height: 110px;
    }
    .in_details h5{
        font-size: 15px;
        font-family: Jost,Helvetica,sans-serif;
    }
    .in_details h5 span{
        font-weight: 700;
        font-size: 14px;
    }
    .invoice_header{
        display: flex;
        justify-content: space-between;
        width: 100%;
        background: #e7c9c9;
    }
    .logo_container{
        text-align: center;
        width: 100%;
        position: relative;
        top: 50%;
        left: 50%;
        margin-top: 60px;
        margin-bottom: -50px;
        transform: translate(-50%, -50%);
    }

    /* .company_address{
        margin-right: auto;
    } */
    .invoice_header h2{
        margin-bottom: 0;
    }
    .invoice_header p{
        margin-top: 10px;
    }
    .logo_container img{
        width: 150px !important;
    }
    .customer_container{
        padding: 0 5px;
        display: flex;
        justify-content: space-between;
    }
    .customer_container h2{
        margin-bottom: 10px;
    }
    .customer_container h4{
        margin-bottom: 10px;
        margin-top: 0;
    }
    .customer_container p{
        margin: 0;
    }
    .in_details{
        margin-top: auto;
        margin-bottom: auto;
    }
    .product_container{
        padding: 0 10px;
        margin-top: 10px;
    }
    .item_table{
        width: 100%;
        text-align: left;
    }
    .item_table td,th{
        padding: 5px 10px;
    }
    .invoice_footer{
        padding: 0 10px;
        display: flex;
        justify-content: space-between;
    }
    .invoice_footer h2{
        margin-bottom: 10px;
    }
    .qrcode_container {
        text-align: center;
        position: relative;
        top: 50px;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .note{
        width: 50%;
    }
    .invoice_footer_amount{
        margin: auto 0;
        background: #e7c9c9;
    }
    .amount_table td,th{
        padding: 5px 10px;
    }
    .in_head{
        margin: 0;
        text-align: center;
        background: #e7c9c9;
        padding: 5px;
    }

    .teeth-container {
        position: relative;
        width: 80%;
    }

    .teeth-container img{
        width: 24%;
    }

    .number-overlay {
        position: absolute;
        top: 36%;
        left: 13%;
        transform: translate(-50%, -50%);
        font-size: 20px;
        font-weight: bold;
        color: #00abff;
        padding: 5px;
        border-radius: 30%;
    }

    .pos-box {
      width: 50%; /* Adjust the width as needed for the POS receipt */
      border: 5px dashed #333;
      padding: 10px;
      position: relative;
    }

    .patient-info {
      text-align: center;
      margin-bottom: 20px;
    }

    .folio-no {
      border: 2px solid #333;
      padding: 10px;
      font-size: 18px;
      /* display: inline-block; */
    }

    .img-f {
      max-width: 15%;
      height: auto;
      display: block;
      margin: 0 auto;
    }

    @media print {
        /* body * {
            visibility: hidden;
        }
            .pos-box, .pos-box * {
            visibility: visible;
        }

        .pos-box {
            position: absolute;
            left: 0;
            top: 0;
        }

        .img-f {
            max-width: 50%;
        } */

        /* Apply the receipt font to the relevant elements */
        .invoice-POS  p,
        .invoice-POS  h2,
        .invoice-POS  th,
        .invoice-POS  td {
            font-family: 'ReceiptFont', monospace;
        }
        /* Adjust styles for printing */
        .invoice-POS  {
            width: 100%;
        }
        .invoice-POS  table {
            width: 100%;
            margin: 0px;
            padding: 0px;
        }
        .invoice-POS  img {
            max-width: 50px !important;;
        }
        /* .invoice-POS  p {
            font-size: 14px;
        } */
        .invoice-POS  h2 {
            font-size: 10px;
        }
        .invoice-POS  th,
        .invoice-POS  td {
            padding: 0px;
            font-size: 10px;
        }
        .invoice-POS  .row.no-print,
        .invoice-POS  .col-md-2 {
            display: none;
        }
        .invoice-POS  button {
            display: none;
        }

        .no-print {
            display: none;
        }
        .print-cert{
            display: none;
        }

        .print-show {
            display: table-row !important;
        }
    }

    .medicine-show{
        display: flex;
        flex-wrap: wrap;
        overflow: auto;
        max-height: 500px;

    }

    .box {
        width: 135px;
        height: 140px;
        background-color: white;
        box-shadow: 0 5px 5px 5px rgba(194, 193, 193, 0.5);
        display: flex;
        flex: 0 0 25%;
        padding: 5px;
        margin: 5px;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }

    /* .box img {
        max-width: 65%;
        max-height: 65%;
        margin-top: 5px;
    } */

    .name {
        font-size: 12px;
        color: rgb(66, 65, 65);
        margin-bottom: 5px;
        justify-content: flex-start;
        text-align: center;
    }

</style>

