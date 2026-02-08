@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="padding: 2rem;">
                            <h4 class="card-title mb-4">Tabel Data Laporan Posyandu</h4>
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3 mb-4">
                                <div class="d-flex flex-column flex-md-row gap-2 w-100 w-lg-auto">
                                    <a href="{{ route('data_laporan.cetakPdf', ['month' => $filterMonth]) }}" class="btn btn-primary p-2 d-flex align-items-center justify-content-center">
                                        <span class="text-light ms-2">Cetak PDF</span>
                                        <i class="fas fa-print ml-2"></i>
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-primary p-2 d-flex align-items-center justify-content-center dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-light ms-2">Filter Bulan</span>
                                            <i class="fas fa-calendar-alt ml-2"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '01']) }}">Januari</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '02']) }}">Februari</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '03']) }}">Maret</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '04']) }}">April</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '05']) }}">Mei</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '06']) }}">Juni</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '07']) }}">Juli</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '08']) }}">Agustus</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '09']) }}">September</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '10']) }}">Oktober</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '11']) }}">November</a>
                                            <a class="dropdown-item" href="{{ route('data_laporan.index', ['month' => '12']) }}">Desember</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 w-lg-auto">
                                    <h5 class="text-primary text-center mb-0">Bulan: 
                                        @php
                                            $months = [
                                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                                                '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                                                '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                                                '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                            ];
                                            echo $months[$filterMonth] ?? 'Semua Bulan';
                                        @endphp
                                    </h5>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                                <table class="table text-center text-light" style="width: 100%; min-width: 1200px;">
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
                                                <tr style="height: 60px;">
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
                                                    <tr style="height: 60px;">
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
@endsection