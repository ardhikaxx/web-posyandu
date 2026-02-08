<nav class="navbar p-0 fixed-top d-flex flex-row" style="background-color: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-mini.png') }}" id="brand-logo-mini" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-center justify-content-between" style="padding-left: 20px; padding-right: 20px;">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" style="background: #f8f9fa; border: none; padding: 10px; border-radius: 10px; transition: all 0.3s ease;">
            <span class="mdi mdi-menu" style="font-size: 22px; color: #495057;"></span>
        </button>
        <div class="d-none d-md-flex align-items-center">
            <div class="brand-logo d-flex align-items-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" style="height: 36px; margin-right: 10px;" />
            </div>
        </div>
        <ul class="navbar-nav navbar-nav-right d-flex align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" id="profileDropdown" href="#" data-toggle="dropdown" style="padding: 8px 14px; border-radius: 10px; transition: all 0.3s ease; background: #f8f9fa;">
                    <div class="d-flex align-items-center">
                        <div class="nav-profile-icon rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 34px; height: 34px; background: #e9ecef;">
                            <i class="mdi mdi-account" style="font-size: 18px; color: #495057;"></i>
                        </div>
                        <span class="mb-0 navbar-profile-name fw-medium" style="color: #333; font-size: 14px;">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down ms-2" style="color: #6c757d; font-size: 16px;"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list rounded-3 mt-2"
                    aria-labelledby="profileDropdown" style="border: none; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.12); min-width: 220px; overflow: hidden;">
                    <div class="dropdown-header py-3 px-3" style="background: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                        <div class="d-flex align-items-center">
                            <div class="dropdown-header-icon rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #667eea;">
                                <i class="mdi mdi-account text-white" style="font-size: 18px;"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold text-dark" style="font-size: 14px;">{{ Auth::user()->name }}</p>
                                <p class="mb-0 text-muted small" style="font-size: 12px;">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <a href="#" class="dropdown-item preview-item rounded-2 mb-1" onclick="event.preventDefault(); confirmLogout();" style="transition: all 0.3s ease; padding: 12px 14px;">
                            <div class="d-flex align-items-center">
                                <div class="preview-icon rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 34px; height: 34px; background: #fee2e2;">
                                    <i class="mdi mdi-logout text-danger" style="font-size: 16px;"></i>
                                </div>
                                <span class="text-dark fw-medium">Logout</span>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item nav-profile d-none d-lg-block ms-2">
                <a class="nav-link nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #e9ecef;" />
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ms-2" type="button"
            data-toggle="offcanvas" style="background: #f8f9fa; border: none; padding: 10px; border-radius: 10px;">
            <span class="mdi mdi-format-line-spacing" style="font-size: 22px; color: #495057;"></span>
        </button>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#667eea',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            background: '#fff',
            customClass: {
                popup: 'rounded-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

<style>
    .navbar-toggler:hover {
        background: #e9ecef !important;
    }
    .nav-link:hover {
        background: #e9ecef !important;
    }
    .dropdown-item:hover {
        background: #f8f9fa !important;
    }
</style>
