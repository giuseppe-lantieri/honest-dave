<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href={{asset("css/main.css") }}>
    <title>Laravel</title>
</head>

<body>
    <x-header />
    <x-main>
        <form method="POST" action="{{ route('register') }}" class="container-col">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" />
            @error('name')
            <h1>{{ $message }}</h1>
            @enderror
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" />
            @error('email')
            <h1>{{ $message }}</h1>
            @enderror
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" />
            @error('password')
            <h1>{{ $message }}</h1>
            @enderror
            <label for="password_confirmation">Confrim password:</label>
            <input type="password" name="password_confirmation" id="password_confimation" />
            @error('password_confirmation')
            <h1>{{ $message }}</h1>
            @enderror
            <input type="submit" value="Registrati">
        </form>
    </x-main>
    <x-footer />
</body>

</html>