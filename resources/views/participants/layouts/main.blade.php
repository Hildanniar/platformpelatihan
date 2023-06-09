<!DOCTYPE html>
<html lang="en">
@include('participants.layouts.partials.head')

<body>
    <div class="wrapper overlay-sidebar">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue2">

                <a href="/dashboard/participant" class="logo">
                    <img src="/assets/admin/img/logodinas.png" height="50px" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle sidenav-overlay-toggler">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->
            @include('admin.layouts.partials.navbar')

        </div>

        @include('participants.layouts.partials.sidebar')

        @yield('container')

    </div>
    @include('participants.layouts.partials.script')
    @yield('scripts')
</body>

</html>
