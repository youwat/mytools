<html>
<head>
    @include('css.master')
</head>
<body>
    @include('header.body')
    <div class="container">
        @yield('content')
    </div>
    @include('js.master')
</body>
</html>