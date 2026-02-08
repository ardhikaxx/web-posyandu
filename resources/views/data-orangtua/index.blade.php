@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Data Orang Tua</h3>
                    <p class="text-muted mb-0">Kelola data orang tua/wali dengan mudah</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary d-flex align-items-center shadow-sm" title="Export Excel">
                        <i class="mdi mdi-file-excel me-2"></i>
                        <span>Export</span>
                    </button>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="input-group" style="max-width: 400px; min-width: 280px;">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="mdi mdi-magnify text-primary"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" id="table-search-data-orangtua" placeholder="Cari Nama Ibu..." autocomplete="off">
                            </div>
                            <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                Total: {{ $data_ibu->total() }} Data
                            </span>
                        </div>
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
                                                <a class="btn btn-primary btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    href="{{ route('data_ibu.edit', $item->no_kk) }}"
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
                        var html = '<div class="row g-3"><div class="col-md-6"><table class="table table-borderless">';
                        html += '<tr><th class="text-muted small py-2">Nomor KK</th><td class="fw-medium py-2">' + response.no_kk + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">NIK Ibu</th><td class="fw-medium py-2">' + response.nik_ibu + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">Nama Ibu</th><td class="fw-medium py-2">' + response.nama_ibu + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">Tempat Lahir</th><td class="fw-medium py-2">' + response.tempat_lahir_ibu + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">Tanggal Lahir</th><td class="fw-medium py-2">' + response.tanggal_lahir_ibu + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">Gol. Darah</th><td class="fw-medium py-2">' + response.gol_darah_ibu + '</td></tr>';
                        html += '</table></div><div class="col-md-6"><table class="table table-borderless">';
                        html += '<tr><th class="text-muted small py-2">NIK Ayah</th><td class="fw-medium py-2">' + response.nik_ayah + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">Nama Ayah</th><td class="fw-medium py-2">' + response.nama_ayah + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">Telepon</th><td class="fw-medium py-2">' + response.telepon + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2">Email</th><td class="fw-medium py-2">' + response.email_orang_tua + '</td></tr>';
                        html += '<tr><th class="text-muted small py-2 py-4">Alamat</th><td class="fw-medium py-2">' + response.alamat + '</td></tr>';
                        html += '</table></div></div>';

                        Swal.fire({
                            title: '<span class="text-primary">Detail Orang Tua</span>',
                            html: html,
                            showCloseButton: true,
                            showConfirmButton: false,
                            width: '700px',
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
    </style>
@endsection
