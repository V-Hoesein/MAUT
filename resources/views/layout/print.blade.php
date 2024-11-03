<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Cetak @yield('title')</title>

    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 13px;
        }

        h1,
        h2 {
            font-weight: normal;
            font-size: 1.5em;
            padding: 0 0 5px 0;
            margin: 0 0 10px 0;
            border-bottom: 4px double black;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td,
        .table th {
            border: 1px solid black;
            padding: 5px;
        }

        .content {
            max-width: 1024px;
            margin: 0 auto;
        }
    </style>
</head>

<body onload="window.print()">

    <section class="content">
        <h1>@yield('title')</h1>
        @yield('content')
    </section>

</body>

</html>