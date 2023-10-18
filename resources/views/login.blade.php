<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href={{asset("css/main.css") }}>
    <title>Login</title>
</head>

<body>
    <x-header />
    <x-main>
        <form method="POST" action="{{ route('login') }}" class="container-col">
            @csrf
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
            <input type="submit" value="Login">
        </form>
    </x-main>
    <x-footer />
</body>

</html>