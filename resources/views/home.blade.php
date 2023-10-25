<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href={{asset("css/main.css") }}>
    <title>Home</title>
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
        <div class="all-width">
            <x-hider title="Le mie Raccolte">
                <div class="mt all-width start">
                    <form action={{ route("collections.store") }} method="post">
                        @csrf
                        <input type="text" name="name" id="name">
                        <input type="submit" value="Crea Raccolta">
                    </form>
                </div>
                <table>
                    @foreach ($my_collections as $collection )
                    <x-table-maker :index="$loop->index" :cols="3">
                        <x-card :route="route('collections.show',[$collection])" :src="asset('img/directory.png')"
                            alt="directory" :name="$collection->name"
                            delete="{{ route('collections.destroy',[$collection]) }}" favorite="null" sfavorite="null"
                            stats="Favorite: {{ $collection->favorites()->count() }}" />
                    </x-table-maker>
                    @endforeach
                </table>
            </x-hider>

            <x-hider title="Le tue raccolte preferite">
                <table>
                    @forelse ($favorites as $collection )
                    <x-table-maker :index="$loop->index" :cols="3">
                        <x-card :route="route('collections.other',[$collection])" :src="asset('img/directory.png')"
                            alt="directory" :name="$collection->name" delete="null"
                            favorite="{{ route('collections.favorite',[$collection]) }}"
                            sfavorite="{{ route('collections.unfavorite',[$collection]) }}"
                            stats="Favorite: {{ $collection->favorites()->count() }}" />
                    </x-table-maker>
                    @empty
                    <span>No Item to show</span>
                    @endforelse
                </table>
            </x-hider>

            <x-hider title="Raccolte da tutti gli utenti">
                <table>
                    @forelse ($collections as $collection )
                    <x-table-maker :index="$loop->index" :cols="3">
                        <x-card :route="route('collections.other',[$collection])" :src="asset('img/directory.png')"
                            alt="directory" :name="$collection->name" delete="null"
                            favorite="{{ route('collections.favorite',[$collection]) }}"
                            sfavorite="{{ route('collections.unfavorite',[$collection]) }}"
                            stats="Favorite: {{ $collection->favorites()->count() }}" />
                    </x-table-maker>
                    @empty
                    <span>No Item to show</span>
                    @endforelse
                </table>
            </x-hider>
        </div>

        @endauth

    </x-main>
    <x-footer />
</body>

</html>