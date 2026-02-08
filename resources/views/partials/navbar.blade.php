<nav class="navbar p-0 fixed-top d-flex flex-row" style="background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center" style="background: #f8f9fa;">
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-mini.png') }}" id="brand-logo-mini" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-center justify-content-between" style="padding-left: 20px; padding-right: 20px;">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" style="background: transparent; border: none; padding: 8px; border-radius: 8px;">
            <span class="mdi mdi-menu" style="font-size: 22px; color: #333;"></span>
        </button>
        <div class="d-none d-md-flex"></div>
        <ul class="navbar-nav navbar-nav-right d-flex align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" id="profileDropdown" href="#" data-toggle="dropdown" style="padding: 6px 10px; border-radius: 8px;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #3b82f6;">
                            <i class="mdi mdi-account text-white" style="font-size: 18px;"></i>
                        </div>
                        <span class="mb-0 navbar-profile-name fw-medium text-dark ms-2" style="font-size: 14px; font-weight: 500;">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down ms-1 text-muted" style="font-size: 16px;"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list rounded-3 mt-2" aria-labelledby="profileDropdown" style="background: white;border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.1); min-width: 200px;">
                    <div class="p-2">
                        <a href="#" class="dropdown-item preview-item rounded-2 mb-1" onclick="event.preventDefault(); confirmLogout();" style="padding: 10px 12px; background: #fff; text-decoration: none;">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-logout text-muted me-2" style="font-size: 18px;"></i>
                                <span class="text-dark" style="font-size: 13px;">Keluar</span>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ms-2" type="button" data-toggle="offcanvas" style="background: transparent; border: none; padding: 8px;">
            <span class="mdi mdi-dots-vertical" style="font-size: 22px; color: #333;"></span>
        </button>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Keluar',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            background: '#fff',
            customClass: {
                confirmButton: 'rounded-1',
                cancelButton: 'rounded-1'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

<style>
    .nav-link:hover {
        background: #f3f4f6 !important;
    }
    .navbar-toggler:focus {
        outline: none;
        box-shadow: none;
    }
    .dropdown-item:hover {
        background: transparent !important;
    }
    .dropdown-item {
        text-decoration: none !important;
    }
</style>
