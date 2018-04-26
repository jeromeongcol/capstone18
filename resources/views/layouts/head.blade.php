<title>Agent Portal</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="csrf-token" content="{{ csrf_token() }}" >
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/linearicons/style.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist-custom.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/steps/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/steps/css/jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/summer-note/summernote.css') }}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('layouts/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('layouts/css/styles.css') }}">
<link  rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.material.min.css') }}" />
<link  rel="stylesheet" href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" />

<!-- ICONS -->
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('layouts/img/apple-icon.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('layouts/img/favicon.png') }}">

<link rel='stylesheet' href="{{ asset('vendor/fullcalendar/lib/cupertino/jquery-ui.min.css') }}" />
<link href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}" rel='stylesheet' />
<link href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}" rel='stylesheet' media='print' />
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fancybox/jquery.fancybox.css') }}" media="screen" />
