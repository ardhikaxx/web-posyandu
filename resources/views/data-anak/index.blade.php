@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Data Anak</h3>
                    <p class="text-muted mb-0">Kelola data anak dengan mudah</p>
                </div>
                <a href="{{ route('data_anak.create') }}" class="btn btn-primary btn-lg d-flex align-items-center shadow-sm" onclick="showForm()">
                    <i class="mdi mdi-plus-circle-outline me-2 fs-5"></i>
                    <span>Tambah Data Anak</span>
                </a>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div class="search-wrapper position-relative" style="max-width: 400px; min-width: 280px; width: 100%;">
                            <i class="mdi mdi-magnify search-icon position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            <input type="text" class="form-control search-input ps-5" id="table-search-data-anak" placeholder="Cari Nama Anak..." autocomplete="off">
                            <div class="search-focus-bg"></div>
                        </div>
                        <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                            Total: {{ $data_anak->total() }} Data
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="table-data-anak" style="width: 100%; min-width: 1200px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th>NIK Anak</th>
                                    <th>Nama Anak</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nama Ibu</th>
                                    <th class="text-center" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_anak as $item)
                                    <tr style="height: 70px;">
                                        <td class="text-center">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                                {{ $loop->iteration + ($data_anak->currentPage() - 1) * $data_anak->perPage() }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-medium">{{ $item->nik_anak }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">{{ $item->nama_anak }}</span>
                                        </td>
                                        <td>
                                            @if($item->jenis_kelamin_anak == 'Perempuan')
                                                <span class="badge bg-pink-subtle text-pink rounded-pill px-3">
                                                    <i class="mdi mdi-gender-female me-1"></i>{{ $item->jenis_kelamin_anak }}
                                                </span>
                                            @else
                                                <span class="badge bg-info-subtle text-info rounded-pill px-3">
                                                    <i class="mdi mdi-gender-male me-1"></i>{{ $item->jenis_kelamin_anak }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $item->nama_ibu }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons d-flex justify-content-center gap-2">
                                                <button class="btn btn-info btn-sm rounded-3 d-flex align-items-center justify-content-center btn-detail"
                                                    data-nik_anak="{{ $item->nik_anak }}"
                                                    title="Detail"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-eye-outline text-white"></i>
                                                </button>
                                                <a class="btn btn-primary btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    href="{{ route('data_anak.edit', $item->nik_anak) }}"
                                                    title="Edit"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-pencil text-white"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    onclick="deleteConfirmation('{{ route('data_anak.hapus', $item->nik_anak) }}')"
                                                    title="Hapus"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-trash-can text-white"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <span class="text-muted small">Menampilkan {{ $data_anak->firstItem() }} - {{ $data_anak->lastItem() }} dari {{ $data_anak->total() }} data</span>
                        {!! $data_anak->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function deleteConfirmation(deleteUrl) {
            Swal.fire({
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                iconColor: '#d33',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = deleteUrl;
                }
            });
        }

        $(document).on('click', '.btn-detail', function() {
            var nik_anak = $(this).data('nik_anak');
            $.ajax({
                url: '/data-anak/detail/' + nik_anak,
                method: 'GET',
                success: function(response) {
                    if (response.anak && response.ibu) {
                        var anak = response.anak;
                        var ibu = response.ibu;
                        
                        var html = '<div class="detail-modal" style="background-color: #fff;">';
                        html += '<div class="text-center mb-4">';
                        html += '<h4 class="fw-bold mb-2" style="color: #333;">Detail Data Anak</h4>';
                        html += '<p class="text-muted small mb-0">Informasi lengkap tentang data anak</p>';
                        html += '</div>';
                        
                        html += '<div class="info-section">';
                        html += '<div class="info-card mb-3">';
                        html += '<div class="card-header-custom d-flex align-items-center py-2 px-3" style="background: linear-gradient(135deg, #0d6efd, #0a58ca); border-radius: 12px 12px 0 0;">';
                        html += '<i class="mdi mdi-account-child text-white me-2"></i>';
                        html += '<span class="text-white fw-semibold">Data Pribadi</span>';
                        html += '</div>';
                        html += '<div class="card-body-custom p-3" style="background-color: #fff; border: 1px solid #e9ecef; border-top: none; border-radius: 0 0 12px 12px;">';
                        html += '<div class="row g-3">';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">NIK</span>';
                        html += '<span class="fw-semibold">' + anak.nik_anak + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nama Lengkap</span>';
                        html += '<span class="fw-semibold">' + anak.nama_anak + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Tempat, Tanggal Lahir</span>';
                        html += '<span class="fw-semibold">' + anak.tempat_lahir_anak + ', ' + anak.tanggal_lahir_anak + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Jenis Kelamin</span>';
                        html += '<span class="fw-semibold">' + anak.jenis_kelamin_anak + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Anak Ke-</span>';
                        html += '<span class="fw-semibold">' + anak.anak_ke + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Golongan Darah</span>';
                        html += '<span class="fw-semibold">' + anak.gol_darah_anak + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        
                        html += '<div class="info-card mb-3">';
                        html += '<div class="card-header-custom d-flex align-items-center py-2 px-3" style="background: linear-gradient(135deg, #0d6efd, #0a58ca); border-radius: 12px 12px 0 0;">';
                        html += '<i class="mdi mdi-account-multiple text-white me-2"></i>';
                        html += '<span class="text-white fw-semibold">Data Orang Tua</span>';
                        html += '</div>';
                        html += '<div class="card-body-custom p-3" style="background-color: #fff; border: 1px solid #e9ecef; border-top: none; border-radius: 0 0 12px 12px;">';
                        html += '<div class="row g-3">';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nomor KK</span>';
                        html += '<span class="fw-semibold">' + anak.no_kk + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nama Ibu</span>';
                        html += '<span class="fw-semibold">' + ibu.nama_ibu + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nama Ayah</span>';
                        html += '<span class="fw-semibold">' + ibu.nama_ayah + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="info-box p-2 rounded-3" style="background-color: #f8f9fa;">';
                        html += '<span class="text-muted small d-block mb-1">Nomor Telepon</span>';
                        html += '<span class="fw-semibold">' + (ibu.telepon || '-') + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        
                        html += '<div class="info-card">';
                        html += '<div class="card-header-custom d-flex align-items-center py-2 px-3" style="background: linear-gradient(135deg, #0d6efd, #0a58ca); border-radius: 12px 12px 0 0;">';
                        html += '<i class="mdi mdi-map-marker text-white me-2"></i>';
                        html += '<span class="text-white fw-semibold">Alamat</span>';
                        html += '</div>';
                        html += '<div class="card-body-custom p-3" style="background-color: #fff; border: 1px solid #e9ecef; border-top: none; border-radius: 0 0 12px 12px;">';
                        html += '<div class="address-box p-3 rounded-3" style="background: linear-gradient(135deg, #0d6efd10, #0a58ca10); border-left: 4px solid #0d6efd;">';
                        html += '<span class="fw-medium">' + (ibu.alamat || '-') + '</span>';
                        html += '</div>';
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

        @if (session('success'))
            Swal.fire({
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
            });
        @endif

        @if (session('info'))
            Swal.fire({
                text: '{{ session('info') }}',
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
            });
        @endif

        (function() {
            const searchInput = document.getElementById('table-search-data-anak');
            const table = document.getElementById('table-data-anak');
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
    </script>
    <style>
        .bg-primary-subtle { background-color: #e7f1ff; }
        .bg-pink-subtle { background-color: #fce4ec; }
        .bg-info-subtle { background-color: #e7f5ff; }
        .text-pink { color: #e83e8c !important; }
        .text-info { color: #0dcaf0 !important; }
        .avatar-sm {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
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
        .btn-soft-danger {
            background-color: #fce4ec;
            border-color: #fce4ec;
            color: #dc3545;
        }
        .btn-soft-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
        .icon-btn {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
        }
        .pagination .page-link {
            border-radius: 8px;
            margin: 0 2px;
            border: none;
            color: #495057;
        }
        .pagination .page-link:hover {
            background-color: #e7f1ff;
            color: #0d6efd;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
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
