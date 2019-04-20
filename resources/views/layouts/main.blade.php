<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Alan Hurtarte">
    <title>My Postcard Code Challenge</title>
    <link rel="stylesheet" href="/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>
<body>
@include('layouts.components.navbar')

<main role="main" class="container-fluid body-wrapper">
    @yield('content')
</main>
<script src="/js/app.js"></script>
@stack('scripts')
</body>
</html>
