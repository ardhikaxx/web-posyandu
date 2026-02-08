@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="padding: 2rem;">
                            <h4 class="card-title mb-4">Tabel Data Posyandu</h4>
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3 mb-4">
                                <div class="d-flex flex-column flex-md-row gap-3 w-100 w-lg-auto">
                                    <a href="{{ route('data_posyandu.create') }}" class="btn btn-primary p-2 d-flex align-items-center justify-content-center">
                                        <span class="text-light ms-2">Tambah Data Posyandu</span>
                                        <i class="fas fa-plus ml-2"></i>
                                    </a>
                                    <a href="{{ route('data_posyandu_terlambat.create') }}" class="btn btn-primary p-2 d-flex align-items-center justify-content-center ms-lg-3">
                                        <span class="text-light ms-2">Tambah Data Terlambat Imunisasi</span>
                                        <i class="fas fa-clock ml-2"></i>
                                    </a>
                                </div>
                                <div class="input-group search-input-group" style="max-width: 400px; min-width: 300px;">
                                    <span class="input-group-text bg-white text-primary border-primary">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-input form-control border-start-0" id="table-search-data-posyandu" placeholder="Cari Nama Anak .." autocomplete="off">
                                    <button type="button" class="btn btn-primary px-3" aria-label="Cari">
                                        <span class="d-none d-lg-inline">Cari</span>
                                        <i class="fas fa-paper-plane ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                                <table class="table text-center text-light" id="table-data-posyandu" style="width: 100%; min-width: 1200px;">
                                    <thead>
                                        <tr>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Nama Anak</th>
                                            <th class="text-primary bg-light" style="width: 10%; padding: 1rem 0.5rem;">TB (cm)</th>
                                            <th class="text-primary bg-light" style="width: 10%; padding: 1rem 0.5rem;">BB (kg)</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Umur Anak (Bulan)</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Tanggal Posyandu</th>
                                            <th class="text-primary bg-light" style="width: 35%; padding: 1rem 0.5rem;">Vaksin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $groupedData = $data_posyandu->groupBy('tanggal_posyandu');
                                        @endphp
                                        @foreach ($groupedData as $date => $group)
                                            @foreach ($group->groupBy('nama_anak') as $nama_anak => $items)
                                                @php
                                                    $groupKey = $loop->parent->iteration . '-' . $loop->iteration;
                                                @endphp
                                                <tr data-search-group="{{ $groupKey }}" style="height: 60px;">
                                                    <td rowspan="{{ $items->count() }}" class="text-center text-primary align-middle" style="padding: 1rem 0.5rem; vertical-align: middle;">
                                                        {{ $nama_anak }}
                                                    </td>
                                                    <td rowspan="{{ $items->count() }}" class="text-center text-primary align-middle" style="padding: 1rem 0.5rem; vertical-align: middle;">
                                                        {{ $items->first()->tb_anak }}
                                                    </td>
                                                    <td rowspan="{{ $items->count() }}" class="text-center text-primary align-middle" style="padding: 1rem 0.5rem; vertical-align: middle;">
                                                        {{ $items->first()->bb_anak }}
                                                    </td>
                                                    <td rowspan="{{ $items->count() }}" class="text-center text-primary align-middle" style="padding: 1rem 0.5rem; vertical-align: middle;">
                                                        {{ $items->first()->umur_anak }}
                                                    </td>
                                                    <td rowspan="{{ $items->count() }}" class="text-center text-primary align-middle" style="padding: 1rem 0.5rem; vertical-align: middle;">
                                                        {{ \Carbon\Carbon::parse($items->first()->tanggal_posyandu)->format('d-m-Y') }}
                                                    </td>
                                                    <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">
                                                        {{ $items->first()->nama_vaksin }}
                                                    </td>
                                                </tr>
                                                @foreach ($items->skip(1) as $item)
                                                    <tr data-search-group="{{ $groupKey }}" style="height: 60px;">
                                                        <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">
                                                            {{ $item->nama_vaksin }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {!! $data_posyandu->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
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
                confirmButtonColor: '#3085d6',
            });
        @endif

        @if (session('info'))
            Swal.fire({
                text: '{{ session('info') }}',
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
        @endif

        (function() {
            const searchInput = document.getElementById('table-search-data-posyandu');
            const table = document.getElementById('table-data-posyandu');
            if (!searchInput || !table) {
                return;
            }

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const normalize = (text) => text.toLowerCase();

            const groupMap = rows.reduce((acc, row) => {
                const key = row.getAttribute('data-search-group') || 'default';
                if (!acc[key]) {
                    acc[key] = [];
                }
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
@endsection