<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (auth()->user()->participants->image == null)
                        <img src="/assets/admin/img/profiledefault.png" alt="..." class="avatar-img rounded-circle">
                    @else
                        <img src="{{ asset('storage/' . auth()->user()->participants->image) }}" alt="..."
                            class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a href="/participant/profile" aria-expanded="true">
                        <span>
                            @if (auth()->user()->levels->name == 'Peserta')
                                {{ auth()->user()->participants->name }}
                                <span class="user-level">{{ auth()->user()->levels->name }}</span>
                            @endif
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::is('dashboard/participant/start*') ? 'active' : '' }}">
                    <a href="/dashboard/participant/start" class="collapsed" aria-expanded="false">
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
                @can('is_participant')
                    <li class="nav-item {{ Request::is('participant/training*') ? 'active' : '' }}">
                        <a href="/participant/training ">
                            <i class="fas fa-file"></i>
                            <p>Jenis Pelatihan</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item {{ Request::is('participant/schedule*') ? 'active' : '' }}">
                        <a href="/participant/schedule">
                            <i class="fas fa-clock"></i>
                            <p>Jadwal Pelatihan</p>
                        </a>
                    </li> --}}
                    <li class="nav-item {{ Request::is('participant/attainment*') ? 'active' : '' }}">
                        <a href="/participant/attainment">
                            <i class="fas fa-file"></i>
                            <p>Hasil Karya Pelatihan</p>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
