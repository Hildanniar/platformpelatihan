<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (auth()->user()->levels->name == 'Mentor')
                        @if (auth()->user()->mentors->image == null)
                            <img src="/assets/admin/img/profiledefault.png" alt="..."
                                class="avatar-img rounded-circle">
                        @else
                            <img src="{{ asset('storage/' . auth()->user()->mentors->image) }}" alt="..."
                                class="avatar-img rounded-circle">
                        @endif
                    @elseif (auth()->user()->levels->name == 'Admin')
                        @if (auth()->user()->admins->image == null)
                            <img src="/assets/admin/img/profiledefault.png" alt="..."
                                class="avatar-img rounded-circle">
                        @else
                            <img src="{{ asset('storage/' . auth()->user()->admins->image) }}" alt="..."
                                class="avatar-img rounded-circle">
                        @endif
                    @endif
                </div>
                <div class="info">
                    <a href="/profile" aria-expanded="true">
                        <span>
                            @if (auth()->user()->levels->name == 'Admin')
                                {{ auth()->user()->admins->name }}
                                <span class="user-level">{{ auth()->user()->levels->name }}</span>
                            @elseif (auth()->user()->levels->name == 'Mentor')
                                {{ auth()->user()->mentors->name }}
                                <span class="user-level">{{ auth()->user()->levels->name }}</span>
                            @endif
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
                @can('is_admin')
                    <li class="nav-item {{ Request::is('admin/admin') ? 'active' : '' }}">
                        <a href="/admin/admin">
                            <i class="fas fa-user"></i>
                            <p>Data Admin</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/participant*') ? 'active' : '' }}">
                        <a href="/admin/participant">
                            <i class="fas fa-user"></i>
                            <p>Data Pribadi Peserta</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/training_participants*') ? 'active' : '' }}">
                        <a href="/admin/training_participants">
                            <i class="fas fa-user"></i>
                            <p>Data Peserta Pelatihan</p>
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
