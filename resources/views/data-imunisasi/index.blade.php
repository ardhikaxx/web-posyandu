@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Data Imunisasi</h3>
                    <p class="text-muted mb-0">Kelola data imunisasi/vaksin dengan mudah</p>
                </div>
                <a href="{{ route('data_imunisasi.create') }}" class="btn btn-primary btn-lg d-flex align-items-center shadow-sm" onclick="showForm()" style="border-radius: 12px;">
                    <i class="mdi mdi-needle me-2 fs-5"></i>
                    <span>Tambah Imunisasi</span>
                </a>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div class="search-wrapper position-relative" style="max-width: 400px; min-width: 280px; width: 100%;">
                            <i class="mdi mdi-magnify search-icon position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            <form action="/data-imunisasi/cari" method="GET" class="d-flex w-100">
                                <input type="text" class="form-control search-input ps-5" name="cari" placeholder="Cari Nama Vaksin..." value="{{ old('cari') }}">
                            </form>
                            <div class="search-focus-bg"></div>
                        </div>
                        <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                            Total: {{ $data_imunisasi->total() }} Vaksin
                        </span>
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
                                            <div class="action-buttons d-flex justify-content-center gap-2">
                                                <a class="btn btn-primary btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                    href="{{ route('data_imunisasi.edit', $item->id_vaksin) }}"
                                                    title="Edit"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="mdi mdi-pencil text-white"></i>
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
