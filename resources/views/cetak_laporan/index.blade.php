@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @php
                $months = [
                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                ];
            @endphp
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-primary mb-1">Laporan Data Posyandu</h3>
                    <p class="text-muted mb-0">Lihat dan cetak laporan data penimbangan anak</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('data_laporan.cetakPdf', ['month' => $filterMonth ?? null]) }}" class="btn btn-danger btn-lg d-flex align-items-center shadow-sm">
                        <i class="mdi mdi-file-pdf-box me-2 fs-5"></i>
                        <span>Cetak PDF</span>
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle d-flex align-items-center px-4 py-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-calendar-filter me-2"></i>
                                    <span>Filter: {{ $months[$filterMonth ?? ''] ?? 'Semua Bulan' }}</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="max-height: 300px; overflow-y: auto;">
                                    <a class="dropdown-item {{ !$filterMonth ? 'active bg-primary' : '' }}" href="{{ route('data_laporan.index') }}">
                                        <i class="mdi mdi-calendar-check me-2"></i>Semua Bulan
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    @foreach ($months as $key => $month)
                                        <a class="dropdown-item {{ $filterMonth == $key ? 'active bg-primary' : '' }}" href="{{ route('data_laporan.index', ['month' => $key]) }}">
                                            <i class="mdi mdi-calendar-month me-2"></i>{{ $month }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                Total: {{ $data_posyandu->total() }} Data
                            </span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="width: 100%; min-width: 1200px;">
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
                                @forelse ($groupedData as $date => $group)
                                    @foreach ($group->groupBy('nama_anak') as $nama_anak => $items)
                                        <tr style="height: 80px;">
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
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="mdi mdi-inbox-outline text-muted" style="font-size: 48px;"></i>
                                                <p class="text-muted mt-3 mb-0">Tidak ada data ditemukan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <span class="text-muted small">Menampilkan {{ $data_posyandu->firstItem() ?? 0 }} - {{ $data_posyandu->lastItem() ?? 0 }} dari {{ $data_posyandu->total() }} data</span>
                        {!! $data_posyandu->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3 text-primary">
                                <i class="mdi mdi-chart-pie me-2"></i>Ringkasan Data
                            </h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3 p-3 bg-primary-subtle rounded-3">
                                        <div class="icon-shape bg-white rounded-circle p-2">
                                            <i class="mdi mdi-human-handsup text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">Total Anak</p>
                                            <h4 class="fw-bold mb-0">{{ $groupedData->flatMap(function($group) { return $group->groupBy('nama_anak'); })->unique()->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3 p-3 bg-success-subtle rounded-3">
                                        <div class="icon-shape bg-white rounded-circle p-2">
                                            <i class="mdi mdi-needle text-success"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">Total Vaksin</p>
                                            <h4 class="fw-bold mb-0">{{ $groupedData->flatMap(function($group) { return $group; })->count() }}</h4>
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
                                <i class="mdi mdi-information me-2"></i>Informasi Laporan
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-calendar text-primary"></i>
                                    <span>Periode: <strong>{{ $months[$filterMonth ?? ''] ?? 'Semua Bulan' }}</strong></span>
                                </li>
                                <li class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-clock-outline text-primary"></i>
                                    <span>Tanggal Cetak: <strong>{{ now()->format('d F Y H:i') }}</strong></span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-printer text-primary"></i>
                                    <span>Status: <span class="badge bg-success-subtle text-success rounded-pill">Siap Dicetak</span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        .icon-shape {
            width: 40px;
            height: 40px;
            display: flex;
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
        .dropdown-item.active {
            background-color: #0d6efd !important;
            color: #fff !important;
        }
    </style>
@endsection
