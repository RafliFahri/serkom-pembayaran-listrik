<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Pembayaran Listrik</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
@include('admin.layouts.header')
@include('admin.layouts.sidebar')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        @yield('content')
    </div>
</div>
</body>
</html>
