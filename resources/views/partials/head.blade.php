    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SIMPAS</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset ('theme/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset ('../theme/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset ('../theme/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('../theme/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <link href="{{asset ('../theme/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    
    <link href="{{asset ('../theme/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{ asset ('../theme/css/style.css') }}" rel="stylesheet">


    <style>
        
        .button {
            position: relative;
            padding: 8px 16px;
            background: #009579;
            border: none;
            outline: none;
            border-radius: 2px;
            cursor: pointer;
        }

        .button:active {
            background: #007a63;
        }

        .button__text {
        /* font: bold 1px "Quicksand", san-serif; */
        color: #ffffff;
        transition: all 0.2s;
        }

        .button--loading .button__text {
        visibility: hidden;
        opacity: 0;
        }

        .button--loading::after {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        border: 4px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: button-loading-spinner 1s ease infinite;
        }

        @keyframes button-loading-spinner {
        from {
            transform: rotate(0turn);
        }

        to {
            transform: rotate(1turn);
        }
        }

    </style>
    