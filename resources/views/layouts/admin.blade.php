<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{@env('APP_NAME')}} admin panel - @yield('title')</title>
    @section('scripts')
        <link rel="stylesheet" type="text/css"
              href="{{ asset('assets/libraries/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}"/>
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
    <script src="{{ asset('assets/js/admin_functions.js') }}"></script>
@show
</body>
</html>
