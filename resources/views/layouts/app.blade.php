<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Dashboard | {{ config('app.name') }}</title>

    @include('layouts._._css')

</head>

<body class="text-gray-700 antialiased">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
        @include('layouts._._sidebar')
        <div class="relative md:ml-64 bg-gray-50">
            @include('layouts._._navbar')

            @yield('content')
        </div>
    </div>

    @include('layouts._._js')
</body>

</html>
