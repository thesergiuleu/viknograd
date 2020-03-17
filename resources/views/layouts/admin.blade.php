<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{@env('APP_NAME')}} admin panel - @yield('title')</title>
    @section('scripts')
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css"
              href="{{ asset('assets/libraries/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/summernote/summernote.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/file_manager.css') }}"/>
        <script src="{{ asset('assets/js/app.js') }}"></script>
    @show

    @stack('scripts')
</head>
<body>
@include("admin.common.header")

<div class="container">
    @if (session()->has('message'))
        @component('common.alert', session()->get('message'))
            {{session()->get('message.msg')}}
        @endcomponent
    @endif
    @yield('content')
</div>
@include("admin.common.footer")
@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('assets/js/summernote/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin_functions.js') }}"></script>
@show
</body>
</html>
