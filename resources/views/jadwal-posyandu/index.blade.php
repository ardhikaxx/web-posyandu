@extends('layouts.template')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-primary mb-1">Jadwal Posyandu</h3>
                <p class="text-muted mb-0">Kelola jadwal posyandu dengan mudah</p>
            </div>
            <a href="{{route('jadwal_posyandu.create')}}" class="btn btn-primary btn-lg d-flex align-items-center shadow-sm" onclick="showForm()">
                <i class="mdi mdi-calendar-plus me-2 fs-5"></i>
                <span>Tambah Jadwal</span>
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                            Total: {{ $jadwal_posyandu->total() }} Jadwal
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
                    <table class="table table-hover align-middle" style="width: 100%; min-width: 800px;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 80px;">No</th>
                                <th>Tanggal Posyandu</th>
                                <th class="text-center">Jam Buka</th>
                                <th class="text-center">Jam Tutup</th>
                                <th class="text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal_posyandu as $item)
                                <tr style="height: 70px;">
                                    <td class="text-center">
                                        <span class="badge bg-warning-subtle text-warning rounded-pill px-3">
                                            {{ $loop->iteration + ($jadwal_posyandu->currentPage() - 1) * $jadwal_posyandu->perPage() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-sm bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-calendar text-warning"></i>
                                            </div>
                                            <div>
                                                <span class="fw-semibold">{{ \Carbon\Carbon::parse($item->jadwal_posyandu)->format('d F Y') }}</span>
                                                <small class="text-muted d-block small">{{ \Carbon\Carbon::parse($item->jadwal_posyandu)->translatedFormat('l') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                            <i class="mdi mdi-clock-outline me-1"></i>{{ $item->jadwal_buka }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                            <i class="mdi mdi-clock-check-outline me-1"></i>{{ $item->jadwal_tutup }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-buttons d-flex justify-content-center gap-2">
                                            <a class="btn btn-primary btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                href="{{ route('jadwal_posyandu.edit', $item->id_jadwal) }}"
                                                title="Edit"
                                                style="width: 36px; height: 36px;">
                                                <i class="mdi mdi-pencil text-white"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm rounded-3 d-flex align-items-center justify-content-center"
                                                onclick="deleteConfirmation('{{ route('jadwal_posyandu.hapus', $item->id_jadwal) }}')"
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
                    <span class="text-muted small">Menampilkan {{ $jadwal_posyandu->firstItem() }} - {{ $jadwal_posyandu->lastItem() }} dari {{ $jadwal_posyandu->total() }} data</span>
                    {!! $jadwal_posyandu->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
</script>
<style>
    .bg-warning-subtle { background-color: #fff3cd; }
    .bg-success-subtle { background-color: #d1e7dd; }
    .bg-danger-subtle { background-color: #f8d7da; }
    .bg-primary-subtle { background-color: #e7f1ff; }
    .text-warning { color: #ffc107 !important; }
    .text-success { color: #198754 !important; }
    .text-danger { color: #dc3545 !important; }
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
