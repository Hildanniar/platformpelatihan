<!-- Navbar & Carousel Start -->
<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
    <a href="#" class="navbar-brand p-0">
        <h1 class="m-0">Platform Pelatihan</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            @if (auth()->user() == null)
                <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                <a href="/about" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About Us</a>
                <a href="/attainment"
                    class="nav-item nav-link {{ Request::is('attainment') ? 'active' : '' }}">Karya</a>
                <a href="/training"
                    class="nav-item nav-link {{ Request::is('training') ? 'active' : '' }}">Pelatihan</a>
            @else
                @if (auth()->user()->levels->name == 'Peserta')
                    <a href="/dashboard/participant"
                        class="nav-item nav-link {{ Request::is('dashboard/participant') ? 'active' : '' }}">Home</a>
                    <a href="/dashboard/participant/attainment"
                        class="nav-item nav-link {{ Request::is('dashboard/participant/attainment') ? 'active' : '' }}">Karya</a>
                    <a href="/dashboard/participant/training"
                        class="nav-item nav-link {{ Request::is('dashboard/participant/training') ? 'active' : '' }}">Pelatihan</a>
                    <a href="/dashboard/participant/start"
                        class="nav-item nav-link {{ Request::is('dashboard/participant/start*') ? 'active' : '' }}">Dashboard</a>
                @else
                    <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                    <a href="/about" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About Us</a>
                    <a href="/attainment"
                        class="nav-item nav-link {{ Request::is('attainment') ? 'active' : '' }}">Karya</a>
                    <a href="/training"
                        class="nav-item nav-link {{ Request::is('training') ? 'active' : '' }}">Pelatihan</a>
                @endif
            @endif
        </div>
        @if (auth()->user() == null)
            <a href="/login" class="btn btn-primary py-2 px-4 ms-3"><i class="fa-solid fa-right-to-bracket"></i>
                Login</a>
            <a href="/register" class="btn btn-primary py-2 px-4 ms-3"><i class="fa-regular fa-address-card"></i>
                Register</a>
        @else
            @if (auth()->user()->levels->name == 'Peserta')
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary py-2 px-4 ms-3"><i
                            class="fas fa-arrow-to-left"></i>Logout</button>
                </form>
            @else
                <a href="/login" class="btn btn-primary py-2 px-4 ms-3"><i class="fa-solid fa-right-to-bracket"></i>
                    Login</a>
                <a href="/register" class="btn btn-primary py-2 px-4 ms-3"><i class="fa-regular fa-address-card"></i>
                    Register</a>
            @endif
        @endif
    </div>
</nav>

<!-- Navbar & Carousel End -->
