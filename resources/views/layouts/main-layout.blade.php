<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'EcomSite')</title>

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    @yield('extra-link')
    @yield('extra-css')

</head>

<body class="text-base leading-normal tracking-normal text-gray-600 bg-white work-sans">

    <!--Nav-->
    @include('components.main.navbar')
    <!--hero-->
    @if (Route::currentRouteName() == 'shop.index')
        @include('components.main.hero')
    @endif
    <!--main-->
    @yield('main')
    <!--footer-->
    @include('components.main.footer')

</body>

</html>
