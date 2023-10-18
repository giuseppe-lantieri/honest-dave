<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href={{asset("css/main.css") }}>
    <script>
        const COLLECTION_ID = {{ $collection->id }}
        const USER_ID = {{ Auth::user()->id }}
        const CSRF_TOKEN = "{{ csrf_token() }}"
    </script>
    <script src={{ asset("js/index.js") }} defer></script>
    <title>Laravel</title>
</head>

<body>
    <x-header />
    <x-main>
        <div class="container-row">
            <h2>Elementi già aggiunti</h2>
        </div>
        <div id="elements" class="button-like">
            <table class="esponi-risultati">
                @foreach ($items as $item )
                @if ($loop->index %5==0)
                <tr>
                    @endif
                    <td>
                        <img src="{{ $item->image }}" alt="{{ $item->name }}">
                        <p>{{ $item->name }}</p>
                        {{-- <p>{{ $item->likes }}</p> --}}
                    </td>
                    @if ($loop->index %5==4)
                </tr>
                @endif
                @endforeach
            </table>
        </div>
        <h2>Aggiungi Elementi</h2>
        <x-search />
    </x-main>
    <x-footer />
</body>

</html>