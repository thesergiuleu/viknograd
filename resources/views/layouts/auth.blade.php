<html>
<head>
    <title>@yield('title')</title>
    @section('scripts')
        <link rel="stylesheet"  type="text/css" href="{{ asset('assets/css/app.css') }}"></link>
    @show
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>