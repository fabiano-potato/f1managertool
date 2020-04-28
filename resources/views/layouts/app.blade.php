<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>F1 Manager Tool - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
</head>
<body>
<div class="container-fluid">
    @yield('content')
</div>
<script>
</script>
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@section('footer_scripts')

@show
</body>
</html>
