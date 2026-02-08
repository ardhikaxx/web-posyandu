@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Data Posyandu</h3>
                    <p class="text-muted mb-0">Kelola data penimbangan dan imunisasi anak</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('data_posyandu.create') }}" class="btn btn-primary btn-lg d-flex align-items-center shadow-sm">
                        <i class="mdi mdi-clipboard-plus me-2 fs-5"></i>
                        <span>Tambah Data</span>
                    </a>
                    <a href="{{ route('data_posyandu_terlambat.create') }}" class="btn btn-warning btn-lg d-flex align-items-center shadow-sm text-dark">
                        <i class="mdi mdi-clock-alert me-2 fs-5"></i>
                        <span>Imunisasi Terlambat</span>
                    </a>
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
                                <input type="text" class="form-control border-start-0 ps-0" id="table-search-data-posyandu" placeholder="Cari Nama Anak..." autocomplete="off">
                            </div>
                            <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                Total: {{ $data_posyandu->total() }} Data
                            </span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="table-data-posyandu" style="width: 100%; min-width: 1200px;">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Anak</th>
                                    <th class="text-center">TB (cm)</th>
                                    <th class="text-center">BB (kg)</th>
                                    <th class="text-center">Umur (Bulan)</th>
                                    <th class="text-center">Tanggal</th>
                                    <th>Vaksin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $groupedData = collect($data_posyandu->items())->groupBy('tanggal_posyandu');
                                @endphp
                                @foreach ($groupedData as $date => $group)
                                    @foreach ($group->groupBy('nama_anak') as $nama_anak => $items)
                                        @php
                                            $groupKey = $loop->parent->iteration . '-' . $loop->iteration;
                                        @endphp
                                        <tr data-search-group="{{ $groupKey }}" style="height: 80px;">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="avatar-sm bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="mdi mdi-human-handsup text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <span class="fw-semibold">{{ $nama_anak }}</span>
                                                        <small class="text-muted d-block small">Anak</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                                    {{ $items->first()->tb_anak }} cm
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info-subtle text-info rounded-pill px-3">
                                                    {{ $items->first()->bb_anak }} kg
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-warning-subtle text-warning rounded-pill px-3">
                                                    {{ $items->first()->umur_anak }} bln
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="fw-medium">{{ \Carbon\Carbon::parse($items->first()->tanggal_posyandu)->format('d F Y') }}</span>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($items->first()->tanggal_posyandu)->translatedFormat('l') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                @foreach ($items as $index => $item)
                                                    <span class="badge {{ $index == 0 ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} rounded-pill px-3 mb-1 d-inline-block">
                                                        <i class="mdi mdi-needle me-1"></i>{{ $item->nama_vaksin }}
                                                    </span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <span class="text-muted small">Menampilkan {{ $data_posyandu->firstItem() }} - {{ $data_posyandu->lastItem() }} dari {{ $data_posyandu->total() }} data</span>
                        {!! $data_posyandu->withQueryString()->links('pagination::bootstrap-5') !!}
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

        @if (session('info'))
            Swal.fire({
                text: '{{ session('info') }}',
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd',
            });
        @endif

        (function() {
            const searchInput = document.getElementById('table-search-data-posyandu');
            const table = document.getElementById('table-data-posyandu');
            if (!searchInput || !table) return;

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const normalize = (text) => text.toLowerCase();

            const groupMap = rows.reduce((acc, row) => {
                const key = row.getAttribute('data-search-group') || 'default';
                if (!acc[key]) acc[key] = [];
                acc[key].push(row);
                return acc;
            }, {});

            const filterGroups = () => {
                const query = normalize(searchInput.value.trim());
                Object.keys(groupMap).forEach((key) => {
                    const groupRows = groupMap[key];
                    const groupText = normalize(groupRows.map((row) => row.textContent).join(' '));
                    const match = query === '' || groupText.includes(query);
                    groupRows.forEach((row) => {
                        row.style.display = match ? '' : 'none';
                    });
                });
            };

            searchInput.addEventListener('input', filterGroups);
        })();
    </script>
    <style>
        .bg-primary-subtle { background-color: #e7f1ff; }
        .bg-success-subtle { background-color: #d1e7dd; }
        .bg-info-subtle { background-color: #e7f5ff; }
        .bg-warning-subtle { background-color: #fff3cd; }
        .bg-secondary-subtle { background-color: #e9ecef; }
        .text-primary { color: #0d6efd !important; }
        .text-success { color: #198754 !important; }
        .text-info { color: #0dcaf0 !important; }
        .text-warning { color: #ffc107 !important; }
        .text-secondary { color: #6c757d !important; }
        .avatar-sm {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
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
