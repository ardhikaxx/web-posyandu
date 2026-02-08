@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Data Orang Tua</h3>
                    <p class="text-muted mb-0">Kelola data orang tua/wali dengan mudah</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div class="search-wrapper position-relative" style="max-width: 400px; min-width: 280px; width: 100%;">
                            <i class="mdi mdi-magnify search-icon position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            <input type="text" class="form-control search-input ps-5" id="table-search-data-orangtua" placeholder="Cari Nama Ibu..." autocomplete="off">
                            <div class="search-focus-bg"></div>
                        </div>
                        <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                            Total: {{ $data_ibu->total() }} Data
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="table-data-orangtua" style="width: 100%; min-width: 1200px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th>NO KK</th>
                                    <th>Nama Ibu</th>
                                    <th>Nama Ayah</th>
                                    <th>Telepon</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_ibu as $item)
                                    <tr style="height: 70px;">
                                        <td class="text-center">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                                {{ $loop->iteration + ($data_ibu->currentPage() - 1) * $data_ibu->perPage() }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-medium">{{ $item->no_kk }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-sm bg-pink-subtle rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-account-woman text-pink"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold d-block">{{ $item->nama_ibu }}</span>
                                                    <small class="text-muted">Ibu</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-sm bg-info-subtle rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-account text-info"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold d-block">{{ $item->nama_ayah }}</span>
                                                    <small class="text-muted">Ayah</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-phone text-muted"></i>
                                                <span>{{ $item->telepon }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons d-flex justify-content-center gap-2">
                                                <a class="btn btn-primary btn-sm rounded-3 d-flex align-items-center justify-content-center btn-edit"
                                                    data-no_kk="{{ $item->no_kk }}"
                                                    title="Edit"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-pencil text-white"></i>
                                                </a>
                                                <button class="btn btn-info btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    data-no_kk="{{ $item->no_kk }}"
                                                    title="Detail"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-eye-outline text-white"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <span class="text-muted small">Menampilkan {{ $data_ibu->firstItem() }} - {{ $data_ibu->lastItem() }} dari {{ $data_ibu->total() }} data</span>
                        {!! $data_ibu->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on('click', '.btn-detail', function() {
            var no_kk = $(this).data('no_kk');
            $.ajax({
                url: '/data-orangtua/detail/' + no_kk,
                method: 'GET',
                success: function(response) {
                    if (response) {
                        var html = '<div class="detail-modal" style="background-color: #fff;">';
                        html += '<div class="text-center mb-4">';
                        html += '<h4 class="fw-bold mb-2" style="color: #333;">Detail Data Orang Tua</h4>';
                        html += '<p class="text-muted small mb-0">Informasi lengkap tentang orang tua/wali</p>';
                        html += '</div>';
                        
                        html += '<div class="info-section">';
                        html += '<div class="info-card mb-3">';
                        html += '<div class="card-header-custom d-flex align-items-center py-2 px-3" style="background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 12px 12px 0 0;">';
                        html += '<i class="mdi mdi-account-woman text-white me-2"></i>';
                        html += '<span class="text-white fw-semibold">Data Ibu</span>';
                        html += '</div>';
                        html += '<div class="card-body-custom p-3" style="background-color: #fff; border: 1px solid #e9ecef; border-top: none; border-radius: 0 0 12px 12px;">';
                        html += '<div class="row g-3">';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nomor KK</span>';
                        html += '<span class="fw-semibold">' + response.no_kk + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">NIK Ibu</span>';
                        html += '<span class="fw-semibold">' + response.nik_ibu + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nama Lengkap</span>';
                        html += '<span class="fw-semibold">' + response.nama_ibu + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Tempat, Tanggal Lahir</span>';
                        html += '<span class="fw-semibold">' + response.tempat_lahir_ibu + ', ' + response.tanggal_lahir_ibu + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Golongan Darah</span>';
                        html += '<span class="fw-semibold">' + response.gol_darah_ibu + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Email</span>';
                        html += '<span class="fw-semibold">' + (response.email_orang_tua || '-') + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        
                        html += '<div class="info-card mb-3">';
                        html += '<div class="card-header-custom d-flex align-items-center py-2 px-3" style="background: linear-gradient(135deg, #11998e, #38ef7d); border-radius: 12px 12px 0 0;">';
                        html += '<i class="mdi mdi-account text-white me-2"></i>';
                        html += '<span class="text-white fw-semibold">Data Ayah</span>';
                        html += '</div>';
                        html += '<div class="card-body-custom p-3" style="background-color: #fff; border: 1px solid #e9ecef; border-top: none; border-radius: 0 0 12px 12px;">';
                        html += '<div class="row g-3">';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">NIK Ayah</span>';
                        html += '<span class="fw-semibold">' + response.nik_ayah + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nama Lengkap</span>';
                        html += '<span class="fw-semibold">' + response.nama_ayah + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nomor Telepon</span>';
                        html += '<span class="fw-semibold">' + response.telepon + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        
                        html += '<div class="info-card">';
                        html += '<div class="card-header-custom d-flex align-items-center py-2 px-3" style="background: linear-gradient(135deg, #f093fb, #f5576c); border-radius: 12px 12px 0 0;">';
                        html += '<i class="mdi mdi-map-marker text-white me-2"></i>';
                        html += '<span class="text-white fw-semibold">Alamat</span>';
                        html += '</div>';
                        html += '<div class="card-body-custom p-3" style="background-color: #fff; border: 1px solid #e9ecef; border-top: none; border-radius: 0 0 12px 12px;">';
                        html += '<div class="address-box p-3 rounded-3" style="background: linear-gradient(135deg, #f093fb10, #f5576c10); border-left: 4px solid #f5576c;">';
                        html += '<span class="fw-medium">' + response.alamat + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        
                        html += '<style>.detail-modal .info-card{border: none !important; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 12px; overflow: hidden;}</style>';
                        
                        Swal.fire({
                            html: html,
                            showCloseButton: true,
                            showConfirmButton: false,
                            width: '680px',
                            padding: '24px',
                            background: '#fff',
                            customClass: {
                                popup: 'rounded-4 shadow-lg'
                            }
                        });
                    } else {
                        Swal.fire({
                            text: 'Data tidak ditemukan!',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc3545',
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        text: 'Terjadi kesalahan saat mengambil data!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#dc3545',
                    });
                }
            });
        });

        $(document).on('click', '.btn-edit', function() {
            var no_kk = $(this).data('no_kk');
            window.location = '/data-orangtua/edit/' + no_kk;
        });

        (function() {
            const searchInput = document.getElementById('table-search-data-orangtua');
            const table = document.getElementById('table-data-orangtua');
            if (!searchInput || !table) return;

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const normalize = (text) => text.toLowerCase();

            const filterRows = () => {
                const query = normalize(searchInput.value.trim());
                rows.forEach((row) => {
                    const match = query === '' || normalize(row.textContent).includes(query);
                    row.style.display = match ? '' : 'none';
                });
            };

            searchInput.addEventListener('input', filterRows);
        })();

        @if(session('success'))
            Swal.fire({
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
            });
        @endif

        @if(session('info'))
            Swal.fire({
                text: '{{ session('info') }}',
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
            });
        @endif
    </script>
    <style>
        .bg-primary-subtle { background-color: #e7f1ff; }
        .bg-pink-subtle { background-color: #fce4ec; }
        .bg-info-subtle { background-color: #e7f5ff; }
        .text-pink { color: #e83e8c !important; }
        .text-info { color: #0dcaf0 !important; }
        .avatar-sm {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
        }
        .btn-soft-primary {
            background-color: #e7f1ff;
            border-color: #e7f1ff;
            color: #0d6efd;
        }
        .btn-soft-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }
.btn-soft-warning {
            background-color: #fff3cd;
            border-color: #fff3cd;
            color: #ffc107;
        }
        .btn-soft-warning:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #fff;
        }
        .search-wrapper {
            width: 100%;
            max-width: 400px;
        }
        .search-input {
            border-radius: 12px;
            border: 1px solid #e9ecef;
            padding: 12px 16px 12px 44px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        .search-input:focus {
            background-color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            outline: none;
        }
        .search-icon {
            z-index: 10;
            font-size: 18px;
            color: #6c757d;
        }
    </style>
@endsection
