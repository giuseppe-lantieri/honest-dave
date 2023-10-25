@if ($route!="null")
<a class="card borded-grey padding" href="{{ $route }}">
    @else
    <div class="card borded-grey padding" href="{{ $route }}">
        @endif
        @if ($delete != "null")
        <div class="all-width end">
            <form method="POST" action={{ $delete }}>
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" value="❌">
            </form>
        </div>
        @endif
        @if ($favorite != "null" && $sfavorite != "null")
        <div class="all-width container-row">
            @if ($stats!="null")
            <div class="start">
                <p class="all-width">{{ $stats }}</p>
            </div>
            @endif
            <div class="end">
                <div>
                    <form method="POST" action={{ $favorite }}>
                        @csrf
                        <input type="submit" value="❤️">
                    </form>
                </div>
                <div>
                    <form method="POST" action={{ $sfavorite }}>
                        @csrf
                        <input type="submit" value="💔">
                    </form>
                </div>
            </div>
        </div>
        <div class="mt"></div>
        @endif

        @if ($src != "null" && $alt != "null")
        <img src="{{$src}}" alt="{{ $alt }}">
        @endif
        @if ($name!="null")
        <p class="mt all-width borded">
            {{ $name }}
        </p>
        @endif

        @if ($route!="null")
</a>
@else
</div>
@endif