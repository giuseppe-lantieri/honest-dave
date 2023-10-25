<script>
    const COLLECTION_ID = {{ $collection }}
    const USER_ID = {{ $user }}
    const KEY_OMDB = "{{ env("OMDB_KEY") }}"
</script>
<script src={{ asset("js/search.js") }} defer></script>
<div class="container-search-bar">
    <form id="search-bar">
        <input type="text" name="search" /><input type="submit" value="Cerca" />
    </form>
</div>

<div id="risultati">
</div>