<div class="mt all-width" onclick="hide(this)">
    <h2 class="borded click">{{ $title }}</h2>
    <div class="all-width" onclick="event.stopPropagation()">
        {{ $slot }}
    </div>
</div>
<script>
    function hide(element){
        element.classList.toggle("hidden-child"); 
    }
</script>