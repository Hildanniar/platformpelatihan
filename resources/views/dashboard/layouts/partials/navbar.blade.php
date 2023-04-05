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
            <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="/tentang" class="nav-item nav-link {{ Request::is('tentang') ? 'active' : '' }}">Tentang</a>
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Karya</a>
                <div class="dropdown-menu m-0">
                    <a href="blog.html" class="dropdown-item">Content Creator</a>
                    <a href="detail.html" class="dropdown-item">Canva</a>
                </div>
            </div> --}}
            <a href="contact.html" class="nav-item nav-link">Karya</a>
            <a href="contact.html" class="nav-item nav-link">Pelatihan</a>
        </div>
        <a href="/login" class="btn btn-primary py-2 px-4 ms-3"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        <a href="/register" class="btn btn-primary py-2 px-4 ms-3"><i class="fa-regular fa-address-card"></i>
            Register</a>
    </div>
</nav>

<!-- Navbar & Carousel End -->
