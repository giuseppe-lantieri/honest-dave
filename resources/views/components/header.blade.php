<header class="header">
    @auth
    <div class="container-row">
        <a href="/">Home</a>
        <span>Welcome {{ Auth::user()->name }}</span>
        <form action={{route("logout") }} method="POST">
            @csrf
            <input type="submit" value="Logout">
        </form>
    </div>
    @endauth
    @guest
    <a href="/login">Login</a>
    <a href="/register">Register</a>
    @endguest
</header>