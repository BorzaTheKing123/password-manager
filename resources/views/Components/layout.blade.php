<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Password Manager</title>
    </head>
    <body>
        <h1>{{ $heading }}</h1>
        {{ $slot }}
    </body>
</html>