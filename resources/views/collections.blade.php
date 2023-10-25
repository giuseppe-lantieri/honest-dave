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
            <x-hider title="Elementi già aggiunti">
                <table class="mt all-width">
                    @foreach ($items as $item )
                    <x-table-maker :index="$loop->index" :cols="3">
                        <x-card route="null" :src="$item->image" :alt="$item->name" :name="$item->name"
                        delete="{{ route('items.destroy',$item) }}" favorite="null" sfavorite="null" stats="{{ $item->likes->count() }}"
                            />
                    </x-table-maker>
                    @endforeach
                </table>
            </x-hider>

            <x-hider title="Aggiungi Elementi">
                <x-search :collection="$collection->id" :user="Auth::user()->id" />
            </x-hider>
        </div>
    </x-main>
    <x-footer />
</body>

</html>