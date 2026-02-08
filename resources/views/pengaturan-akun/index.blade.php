@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Pengaturan Akun</h3>
                    <p class="text-muted mb-0">Kelola akun admin dengan mudah</p>
                </div>
                <a href="{{ route('pengaturanakun.create') }}" class="btn btn-primary btn-lg d-flex align-items-center shadow-sm" onclick="showForm()">
                    <i class="mdi mdi-account-plus me-2 fs-5"></i>
                    <span>Tambah Admin</span>
                </a>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="input-group" style="max-width: 400px; min-width: 280px;">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="mdi mdi-magnify text-primary"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" id="table-search-pengaturan-akun" placeholder="Cari Nama Admin..." autocomplete="off">
                            </div>
                            <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                Total: {{ $pengaturan_akun->total() }} Admin
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary btn-sm" title="Export Excel">
                                <i class="mdi mdi-file-excel"></i>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" title="Print">
                                <i class="mdi mdi-printer"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="table-pengaturan-akun" style="width: 100%; min-width: 900px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 80px;">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaturan_akun as $item)
                                    <tr style="height: 80px;">
                                        <td class="text-center">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                                {{ $loop->iteration + ($pengaturan_akun->currentPage() - 1) * $pengaturan_akun->perPage() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-sm {{ $item->jenis_kelamin == 'Perempuan' ? 'bg-pink-subtle' : 'bg-info-subtle' }} rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-account {{ $item->jenis_kelamin == 'Perempuan' ? 'text-pink' : 'text-info' }}"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold">{{ $item->name }}</span>
                                                    <small class="text-muted d-block small">Admin</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-email-outline text-muted"></i>
                                                <span>{{ $item->email }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($item->jenis_kelamin == 'Perempuan')
                                                <span class="badge bg-pink-subtle text-pink rounded-pill px-3">
                                                    <i class="mdi mdi-gender-female me-1"></i>{{ $item->jenis_kelamin }}
                                                </span>
                                            @else
                                                <span class="badge bg-info-subtle text-info rounded-pill px-3">
                                                    <i class="mdi mdi-gender-male me-1"></i>{{ $item->jenis_kelamin }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons d-flex justify-content-center gap-2">
                                                <a class="btn btn-primary btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    href="{{ route('pengaturanakun.edit', $item->id) }}"
                                                    title="Edit"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-pencil text-white"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    onclick="deleteConfirmation('{{ route('pengaturanakun.hapus', $item->id) }}')"
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
                        <span class="text-muted small">Menampilkan {{ $pengaturan_akun->firstItem() }} - {{ $pengaturan_akun->lastItem() }} dari {{ $pengaturan_akun->total() }} data</span>
                        {!! $pengaturan_akun->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3 text-primary">
                                <i class="mdi mdi-account-group me-2"></i>Statistik Akun
                            </h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3 p-3 bg-primary-subtle rounded-3">
                                        <div class="icon-shape bg-white rounded-circle p-2">
                                            <i class="mdi mdi-account-multiple text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">Total Admin</p>
                                            <h4 class="fw-bold mb-0">{{ $pengaturan_akun->total() }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3 p-3 bg-pink-subtle rounded-3">
                                        <div class="icon-shape bg-white rounded-circle p-2">
                                            <i class="mdi mdi-account-check text-pink"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">Admin Aktif</p>
                                            <h4 class="fw-bold mb-0">{{ $pengaturan_akun->total() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3 text-primary">
                                <i class="mdi mdi-shield-account me-2"></i>Informasi Keamanan
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-shield-check text-success"></i>
                                    <span>Semua akun terverifikasi</span>
                                </li>
                                <li class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-lock-outline text-primary"></i>
                                    <span>Password terenkripsi</span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-clock-outline text-primary"></i>
                                    <span>Terakhir diperbarui: <strong>{{ now()->format('d F Y') }}</strong></span>
                                </li>
                            </ul>
                        </div>
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
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                iconColor: '#dc3545',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = deleteUrl;
                }
            });
        }

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

        (function() {
            const searchInput = document.getElementById('table-search-pengaturan-akun');
            const table = document.getElementById('table-pengaturan-akun');
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
        .text-success { color: #198754 !important; }
        .avatar-sm {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
        }
        .icon-shape {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
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
            background-color: #f8d7da;
            border-color: #f8d7da;
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
    </style>
@endsection
