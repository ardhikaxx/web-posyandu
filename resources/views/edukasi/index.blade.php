@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Edukasi</h3>
                    <p class="text-muted mb-0">Kelola artikel edukasi kesehatan dengan mudah</p>
                </div>
                <a href="{{ route('edukasi.create') }}" class="btn btn-primary btn-lg d-flex align-items-center shadow-sm" onclick="showForm()">
                    <i class="mdi mdi-note-plus me-2 fs-5"></i>
                    <span>Tambah Edukasi</span>
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
                                <input type="text" class="form-control border-start-0 ps-0" id="table-search-edukasi" placeholder="Cari Judul Edukasi..." autocomplete="off">
                            </div>
                            <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                Total: {{ $edukasi->total() }} Artikel
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
                        <table class="table table-hover align-middle" id="table-edukasi" style="width: 100%; min-width: 1000px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 80px;">No</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th class="text-center" style="width: 120px;">Foto</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($edukasi as $item)
                                    <tr style="height: 80px;">
                                        <td class="text-center">
                                            <span class="badge bg-info-subtle text-info rounded-pill px-3">
                                                {{ $loop->iteration + ($edukasi->currentPage() - 1) * $edukasi->perPage() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-sm bg-info-subtle rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-book-open-variant text-info"></i>
                                                </div>
                                                <span class="fw-semibold">{{ strlen($item->judul) > 35 ? substr($item->judul, 0, 35) . '...' : $item->judul }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ substr($item->isi, 0, 80) }}{{ strlen($item->isi) > 80 ? '...' : '' }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($item->foto)
                                                <img src="data:image/jpeg;base64,{{ base64_encode($item->foto) }}" alt="Edukasi Foto" style="width: 55px; height: 55px; object-fit: cover; border-radius: 10px; border: 2px solid #e9ecef;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; border-radius: 10px; background-color: #f8f9fa;">
                                                    <i class="mdi mdi-image-off text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons d-flex justify-content-center gap-2">
                                                <a class="btn btn-primary btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    href="{{ route('edukasi.edit', $item->id_edukasi) }}"
                                                    title="Edit"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-pencil text-white"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    onclick="deleteConfirmation('{{ route('edukasi.hapus', $item->id_edukasi) }}')"
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
                        <span class="text-muted small">Menampilkan {{ $edukasi->firstItem() }} - {{ $edukasi->lastItem() }} dari {{ $edukasi->total() }} data</span>
                        {!! $edukasi->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
            });
        @endif

        function deleteConfirmation(deleteUrl) {
            Swal.fire({
                text: 'Apakah Anda yakin ingin menghapus data ini?',
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

        (function() {
            const searchInput = document.getElementById('table-search-edukasi');
            const table = document.getElementById('table-edukasi');
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
        .bg-info-subtle { background-color: #e7f5ff; }
        .bg-primary-subtle { background-color: #e7f1ff; }
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
