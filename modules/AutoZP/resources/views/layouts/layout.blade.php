<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#efefef">
    <meta name="Description" content="一个极简综评客户端。">
    <link rel="manifest" href="/autozp/manifest.json">
    @yield("meta")
    <link rel="stylesheet" href="{{ asset(mix("css/app.css", "vendor/jingbh/autozp")) }}">
    <title>@yield("title", "主页") - AutoZP</title>
</head>
<body>
@yield("content")
<script src="{{ asset(mix("js/manifest.js", "vendor/jingbh/autozp")) }}"></script>
<script src="{{ asset(mix("js/vendor.js", "vendor/jingbh/autozp")) }}"></script>
@yield("bodyjs")
</body>
</html>
