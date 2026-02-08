@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Data Imunisasi</h3>
                    <p class="text-muted mb-0">Kelola data imunisasi/vaksin dengan mudah</p>
                </div>
                <a href="{{ route('data_imunisasi.create') }}" class="btn btn-primary btn-lg d-flex align-items-center shadow-sm" onclick="showForm()">
                    <i class="mdi mdi-needle me-2 fs-5"></i>
                    <span>Tambah Imunisasi</span>
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
                                <form action="/data-imunisasi/cari" method="GET" class="d-flex w-100">
                                    <input type="text" class="form-control border-start-0 ps-0" name="cari" placeholder="Cari Nama Vaksin..." value="{{ old('cari') }}">
                                </form>
                            </div>
                            <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                Total: {{ $data_imunisasi->total() }} Vaksin
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
                        <table class="table table-hover align-middle" style="width: 100%; min-width: 600px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 80px;">No</th>
                                    <th>Nama Vaksin</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_imunisasi as $item)
                                    <tr style="height: 70px;">
                                        <td class="text-center">
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                                {{ $loop->iteration + ($data_imunisasi->currentPage() - 1) * $data_imunisasi->perPage() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-sm bg-success-subtle rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-needle text-success"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold">{{ $item->nama_vaksin }}</span>
                                                    <small class="text-muted d-block small">Vaksin</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-soft-primary btn-sm icon-btn rounded-3"
                                                    href="{{ route('data_imunisasi.edit', $item->id_vaksin) }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <span class="text-muted small">Menampilkan {{ $data_imunisasi->firstItem() }} - {{ $data_imunisasi->lastItem() }} dari {{ $data_imunisasi->total() }} data</span>
                        {!! $data_imunisasi->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
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
        .bg-success-subtle { background-color: #d1e7dd; }
        .bg-primary-subtle { background-color: #e7f1ff; }
        .text-success { color: #198754 !important; }
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
