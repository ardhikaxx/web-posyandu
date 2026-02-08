<nav class="navbar p-0 fixed-top d-flex flex-row" style="background-color: #fff; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-mini.png') }}" id="brand-logo-mini" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-center justify-content-between" style="padding-left: 20px; padding-right: 20px;">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" style="background: none; border: none; padding: 8px; border-radius: 8px; transition: all 0.3s ease;">
            <span class="mdi mdi-menu" style="font-size: 24px; color: #667eea;"></span>
        </button>
        <div class="d-none d-md-flex align-items-center">
            <div class="brand-logo d-flex align-items-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" style="height: 40px; margin-right: 12px;" />
            </div>
        </div>
        <ul class="navbar-nav navbar-nav-right d-flex align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" id="profileDropdown" href="#" data-toggle="dropdown" style="padding: 8px 16px; border-radius: 12px; transition: all 0.3s ease; background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);">
                    <div class="d-flex align-items-center">
                        <div class="nav-profile-icon rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; background: linear-gradient(135deg, #667eea, #764ba2);">
                            <i class="mdi mdi-account text-white" style="font-size: 18px;"></i>
                        </div>
                        <span class="mb-0 navbar-profile-name fw-semibold" style="color: #333; font-size: 14px;">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down ms-1" style="color: #667eea; font-size: 16px;"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list rounded-3 mt-2"
                    aria-labelledby="profileDropdown" style="border: none; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); overflow: hidden; padding: 8px;">
                    <div class="dropdown-header bg-white py-2 px-3 mb-2" style="border-bottom: 1px solid #f0f0f0;">
                        <div class="d-flex align-items-center">
                            <div class="dropdown-header-icon rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: linear-gradient(135deg, #667eea, #764ba2);">
                                <i class="mdi mdi-account text-white" style="font-size: 20px;"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold text-dark">{{ Auth::user()->name }}</p>
                                <p class="mb-0 text-muted small" style="font-size: 12px;">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="dropdown-item preview-item rounded-2 mb-1" onclick="event.preventDefault(); confirmLogout();" style="transition: all 0.3s ease; padding: 12px 16px;">
                        <div class="d-flex align-items-center">
                            <div class="preview-icon rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px; background: #fee2e2;">
                                <i class="mdi mdi-logout text-danger" style="font-size: 16px;"></i>
                            </div>
                            <div>
                                <p class="preview-subject mb-0 text-dark fw-medium">Logout</p>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item nav-profile d-none d-lg-block">
                <a class="nav-link nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #667eea;" />
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ms-2" type="button"
            data-toggle="offcanvas" style="background: none; border: none; padding: 8px; border-radius: 8px;">
            <span class="mdi mdi-format-line-spacing" style="font-size: 24px; color: #667eea;"></span>
        </button>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function confirmLogout() {
        Swal.fire({
            title: '<span style="color: #333;">Konfirmasi Logout</span>',
            html: '<span style="color: #666;">Apakah Anda yakin ingin keluar dari aplikasi?</span>',
            icon: 'question',
            iconColor: '#667eea',
            showCancelButton: true,
            confirmButtonColor: '#667eea',
            cancelButtonColor: '#dc3545',
            confirmButtonText: '<span style="color: #fff;">Ya, Logout</span>',
            cancelButtonText: '<span style="color: #fff;">Batal</span>',
            background: '#fff',
            customClass: {
                popup: 'rounded-3',
                confirmButton: 'rounded-2'
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
        background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%) !important;
    }
    .dropdown-item:hover {
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%) !important;
    }
</style>
