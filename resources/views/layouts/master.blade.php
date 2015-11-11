<html>
<head>
    @include('header.header');
    @include('css.master')
    @yield('local_css')
</head>
<body>
    <div class="container">
        @include('header.body')
        @yield('content')
    </div>
    @include('js.master')
    @yield('local_javascript')
</body>
</html>