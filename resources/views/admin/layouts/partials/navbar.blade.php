<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

    <div class="container-fluid">
        <div class="collapse" id="search-nav">
            <form class="navbar-left navbar-form nav-search mr-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        {{-- <button type="submit" class="btn btn-search pr-1">
                            <i class="fa fa-search search-icon"></i>
                        </button> --}}
                    </div>
                    {{-- <input type="text" placeholder="Search ..." class="form-control"> --}}
                </div>
            </form>
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        @if (auth()->user()->levels->name == 'Peserta')
                            @if (auth()->user()->participants->image == null)
                                <img src="/assets/admin/img/profiledefault.png" alt="..."
                                    class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('storage/' . auth()->user()->participants->image) }}" alt="..."
                                    class="avatar-img rounded-circle">
                            @endif
                        @endif
                        @if (auth()->user()->levels->name == 'Mentor')
                            @if (auth()->user()->mentors->image == null)
                                <img src="/assets/admin/img/profiledefault.png" alt="..."
                                    class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('storage/' . auth()->user()->mentors->image) }}" alt="..."
                                    class="avatar-img rounded-circle">
                            @endif
                        @endif
                        @if (auth()->user()->levels->name == 'Admin')

                            @if (auth()->user()->admins->image == null)
                                <img src="/assets/admin/img/profiledefault.png" alt="..."
                                    class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('storage/' . auth()->user()->admins->image) }}" alt="..."
                                    class="avatar-img rounded-circle">
                            @endif
                        @endif
                    </div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown" data-toggle="dropdown" href="#" aria-expanded="false">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (auth()->user()->levels->name == 'Peserta')
                            {{ auth()->user()->participants->name }}
                        @elseif (auth()->user()->levels->name == 'Mentor')
                            {{ auth()->user()->mentors->name }}
                        @else
                            {{ auth()->user()->admins->name }}
                        @endif
                    </button>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        @if (auth()->user()->levels->name == 'Peserta')
                            <li>
                                <a class="dropdown-item" href="{{ route('update.profile') }}">Profil Saya</a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.update') }}">Profil Saya</a>
                            </li>
                        @endif
                        <hr class="dropdown-divider">
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>


</nav>
<!-- End Navbar -->
