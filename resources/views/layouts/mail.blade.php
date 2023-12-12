<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* Add any custom styles for your email layout here */
    </style>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: 'Arial', sans-serif;">
        @yield('content')
    </div>
</body>
</html>
