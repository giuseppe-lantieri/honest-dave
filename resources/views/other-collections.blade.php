<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href={{asset("css/main.css") }}>
    <title>Collections</title>
</head>

<body>
    <x-header />
    <x-main>
        <div class="all-width">
            <table class="mt all-width">
                @foreach ($items as $item )
                <x-table-maker :index="$loop->index" :cols="3">
                    <x-card route="null" :src="$item->image" :alt="$item->name" :name="$item->name"
                        delete="null" favorite="{{route('items.like',[$item])}}" sfavorite="{{route('items.unlike',[$item])}}"
                        stats="Like: {{$item->likes->count()}}"/>
                </x-table-maker>
                @endforeach
            </table>
        </div>
    </x-main>
    <x-footer />
</body>

</html>