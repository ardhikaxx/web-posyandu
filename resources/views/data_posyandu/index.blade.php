@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tabel Data Posyandu</h4>
                                <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                                    <div class="mt-1 row d-flex justify-content-center flex-column flex-lg-row me-3">
                                        <a href="{{ route('data_posyandu.create') }}" class="btn btn-primary me-lg-3 mb-2 mb-lg-0 p-2" onclick="showForm()"><span class="text-light ms-2">Tambah Data Posyandu</span><i class="fas fa-plus ml-2"></i></a>
                                        <a href="{{ route('data_posyandu_terlambat.create') }}" class="btn btn-primary ml-2" onclick="showForm()"><span class="text-light ms-2">Tambah Data Terlambat Imunisasi</span><i class="fas fa-clock ml-2"></i></a>
                                    </div>
                                    <div class="input-group search-input-group ml-3 ml-lg-0" style="max-width: 360px;">
                                        <span class="input-group-text bg-white text-primary border-primary"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-input form-control border-start-0" id="table-search-data-posyandu" placeholder="Cari Nama Anak .." autocomplete="off">
                                        <button type="button" class="btn btn-primary px-3" aria-label="Cari"><span class="d-none d-lg-inline">Cari</span><i class="fas fa-paper-plane ms-1"></i></button>
                                    </div>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table text-center text-light mt-3" id="table-data-posyandu">
                                        <thead>
                                            <tr>
                                                <th class="text-primary">Nama Anak</th>
                                                <th class="text-primary">TB (cm)</th>
                                                <th class="text-primary">BB (kg)</th>
                                                <th class="text-primary">Umur Anak (Bulan)</th>
                                                <th class="text-primary">Tanggal Posyandu</th>
                                                <th class="text-primary">Vaksin</th>
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
                                                    <tr data-search-group="{{ $groupKey }}">
                                                        <td rowspan="{{ $items->count() }}" class="text-center text-primary mb-3">{{ $nama_anak }}</td>
                                                        <td rowspan="{{ $items->count() }}" class="text-center text-primary mb-3">{{ $items->first()->tb_anak }}</td>
                                                        <td rowspan="{{ $items->count() }}" class="text-center text-primary mb-3">{{ $items->first()->bb_anak }}</td>
                                                        <td rowspan="{{ $items->count() }}" class="text-center text-primary mb-3">{{ $items->first()->umur_anak }}</td>
                                                        <td rowspan="{{ $items->count() }}" class="text-center text-primary mb-3">{{ \Carbon\Carbon::parse($items->first()->tanggal_posyandu)->format('d-m-Y') }}</td>
                                                        <td class="text-center text-primary">{{ $items->first()->nama_vaksin }}</td>
                                                    </tr>
                                                    @foreach ($items->skip(1) as $item)
                                                        <tr data-search-group="{{ $groupKey }}">
                                                            <td class="text-center text-primary">{{ $item->nama_vaksin }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! $data_posyandu->withQueryString()->links('pagination::bootstrap-5') !!}
                                </div>
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
