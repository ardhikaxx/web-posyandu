<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #fff; box-shadow: 1px 0 3px rgba(0,0,0,0.08);">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="background: #fff; border-bottom: 1px solid #f0f0f0;">
        <a class="sidebar-brand brand-logo" href="{{ route('home')}}"><img src="{{ asset('assets/images/logo.png') }}" id="brand-logo" alt="logo" style="height: 40px;" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('home')}}"><img src="{{ asset('assets/images/logo-mini.png') }}" id="brand-logo-mini" alt="logo" /></a>
    </div>
    <ul class="nav" style="padding: 16px 12px;">
        <li class="nav-item nav-category mb-2">
            <span class="nav-link" style="color: #999; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Menu</span>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('home')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-view-dashboard" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('pages.data_anak')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-account-child" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Data Anak</span>
            </a>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('pages.data_ibu')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Data Orang Tua</span>
            </a>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('pages.data_imunisasi')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-shield-check" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Data Imunisasi</span>
            </a>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('pages.jadwal')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-calendar-clock" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Jadwal Posyandu</span>
            </a>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('pages.edukasi')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-book-open-page-variant" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Edukasi</span>
            </a>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('pages.penimbangan')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-scale-bathroom" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Data Posyandu</span>
            </a>
        </li>
        <li class="nav-item menu-items mb-1">
            <a class="nav-link" href="{{ route('data_laporan.index') }}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-file-chart" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Cetak Laporan</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('pages.pengaturanakun')}}" style="border-radius: 8px; padding: 12px 14px;">
                <span class="menu-icon">
                    <i class="mdi mdi-cog" style="color: #666;"></i>
                </span>
                <span class="menu-title" style="color: #333; font-weight: 500;">Pengaturan Akun</span>
            </a>
        </li>
    </ul>
</nav>

<style>
    .sidebar .nav-link:hover {
        background: #f3f4f6 !important;
    }
    .sidebar .nav-link:hover .menu-icon i {
        color: #3b82f6 !important;
    }
    .sidebar .nav-link:hover .menu-title {
        color: #3b82f6 !important;
    }
    .sidebar .nav-link.active {
        background: #eff6ff !important;
    }
    .sidebar .nav-link.active .menu-icon i {
        color: #3b82f6 !important;
    }
    .sidebar .nav-link.active .menu-title {
        color: #3b82f6 !important;
        font-weight: 600 !important;
    }
</style>
