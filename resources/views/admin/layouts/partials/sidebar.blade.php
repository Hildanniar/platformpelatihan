<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (auth()->user()->image == null)
                        <img src="/assets/admin/img/profiledefault.png" alt="..." class="avatar-img rounded-circle">
                    @else
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="..."
                            class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ auth()->user()->name }}
                            <span class="user-level">{{ auth()->user()->levels->name }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                    <a href="/admin" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                {{-- <li class="nav-item {{ Request::is('admin/pengguna') ? 'active' : '' }}">
                    <a href="/admin/pengguna">
                        <i class="fas fa-user-circle"></i>
                        <p>Akun Pengguna</p>
                    </a>
                </li> --}}
                @can('is_admin')
                    <li class="nav-item {{ Request::is('admin/participant*') ? 'active' : '' }}">
                        <a href="/admin/participant">
                            <i class="fas fa-user"></i>
                            <p>Data Peserta</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/mentor*') ? 'active' : '' }}">
                        <a href="/admin/mentor">
                            <i class="fas fa-user"></i>
                            <p>Data Mentor</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/survey*') ? 'active' : '' }}">
                        <a href="/admin/survey">
                            <i class="fas fa-users"></i>
                            <p>Survey Pelatihan</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/type_training*') ? 'active' : '' }}">
                        <a href="/admin/type_training ">
                            <i class="fas fa-file"></i>
                            <p>Jenis Pelatihan</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/certificate*') ? 'active' : '' }}">
                        <a href="/admin/certificate">
                            <i class="fas fa-file"></i>
                            <p>Sertifikat Pelatihan</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item {{ Request::is('admin/materi_tasks*') ? 'active' : '' }}">
                    <a href="/admin/materi_tasks">
                        <i class="fas fa-book-open"></i>
                        <p>Data Materi & Tugas</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/schedule*') ? 'active' : '' }}">
                    <a href="/admin/schedule">
                        <i class="fas fa-clock"></i>
                        <p>Jadwal Pelatihan</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('admin/attainment*') ? 'active' : '' }}">
                    <a href="/admin/attainment">
                        <i class="fas fa-file"></i>
                        <p>Hasil Karya Pelatihan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
