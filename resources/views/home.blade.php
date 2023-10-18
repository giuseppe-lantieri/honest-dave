<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href={{asset("css/main.css") }}>
    <script src={{ asset("js/index.js") }} defer></script>
    <title>Laravel</title>
</head>

<body>
    <x-header />
    <x-main>
        @guest
        <div>
            <h1>Benvenuti nel sito di Ganzio</h1>
            <p>
                Questo sito realizzato con poche e quasi minime risorse esterne serve per
                semplicemente realizzare piccoli corsi che potranno essere usufruiti da Samuele e Valentina
            </p>
        </div>
        @endguest
        @auth

        <form action={{ route("collections.store") }} method="post">
            @csrf
            <input type="text" name="name" id="name">
            <input type="submit" value="Crea Raccolta">
        </form>

        @foreach ( $cs as $collection )
        <a href={{ route("collections.show",[$collection]) }}>{{ $collection->name }}</a>

        @endforeach
        @endauth

    </x-main>
    <x-footer />
</body>

</html>