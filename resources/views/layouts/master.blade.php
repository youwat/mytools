{{--
このレイアウトを継承し、下記のページ特有のセクションを定義してください。
local_head       : ページ特有のヘッダを定義
local_css        : ページ特有のCSSを定義
content          : ページ内容を定義
local_javascript : ページ特有のjavascriptを定義
--}}
<html>
<head>
    <!-- header -->
    @include('header.header')
    @yield('local_head')
    <!-- css -->
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