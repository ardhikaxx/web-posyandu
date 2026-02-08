@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-0 text-primary fw-bold">Dashboard Posyandu</h2>
                        <p class="text-muted mb-0">Selamat datang kembali, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item active">Home</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1 small fw-semibold">Total Data Anak</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $jumlah_anak }}</h3>
                                </div>
                                <div class="icon-shape bg-primary-subtle rounded-3 p-3">
                                    <i class="mdi mdi-human-handsup fs-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="mt-3 d-flex align-items-center">
                                <span class="badge bg-primary-subtle text-primary fw-semibold px-2 py-1 rounded-pill">
                                    <i class="mdi mdi-trending-up me-1"></i>Active
                                </span>
                                <span class="text-muted ms-2 small">Anak terdaftar</span>
                            </div>
                        </div>
                        <div class="card-footer bg-primary py-2" style="border: none;"></div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1 small fw-semibold">Anak Perempuan</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $jumlah_anak_perempuan }}</h3>
                                </div>
                                <div class="icon-shape bg-pink-subtle rounded-3 p-3">
                                    <i class="mdi mdi-human-female fs-4" style="color: #e83e8c;"></i>
                                </div>
                            </div>
                            <div class="mt-3 d-flex align-items-center">
                                <span class="badge bg-pink-subtle text-pink fw-semibold px-2 py-1 rounded-pill" style="background-color: #fce4ec; color: #e83e8c;">
                                    <i class="mdi mdi-gender-female me-1"></i>Perempuan
                                </span>
                                <span class="text-muted ms-2 small">Data perempuan</span>
                            </div>
                        </div>
                        <div class="card-footer py-2" style="border: none; background: linear-gradient(90deg, #e83e8c 0%, #ff69b4 100%);"></div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1 small fw-semibold">Anak Laki-laki</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $jumlah_anak_laki_laki }}</h3>
                                </div>
                                <div class="icon-shape bg-info-subtle rounded-3 p-3">
                                    <i class="mdi mdi-human-male fs-4" style="color: #0dcaf0;"></i>
                                </div>
                            </div>
                            <div class="mt-3 d-flex align-items-center">
                                <span class="badge bg-info-subtle text-info fw-semibold px-2 py-1 rounded-pill" style="background-color: #e7f5ff; color: #0dcaf0;">
                                    <i class="mdi mdi-gender-male me-1"></i>Laki-laki
                                </span>
                                <span class="text-muted ms-2 small">Data laki-laki</span>
                            </div>
                        </div>
                        <div class="card-footer py-2" style="border: none; background: linear-gradient(90deg, #0dcaf0 0%, #20c997 100%);"></div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1 small fw-semibold">Total Orang Tua</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $jumlah_orang_tua }}</h3>
                                </div>
                                <div class="icon-shape bg-warning-subtle rounded-3 p-3">
                                    <i class="mdi mdi-account-child fs-4 text-warning"></i>
                                </div>
                            </div>
                            <div class="mt-3 d-flex align-items-center">
                                <span class="badge bg-warning-subtle text-warning fw-semibold px-2 py-1 rounded-pill" style="background-color: #fff3cd; color: #ffc107;">
                                    <i class="mdi mdi-account-multiple me-1"></i>Terdaftar
                                </span>
                                <span class="text-muted ms-2 small">Orang tua/wali</span>
                            </div>
                        </div>
                        <div class="card-footer py-2" style="border: none; background: linear-gradient(90deg, #ffc107 0%, #fd7e14 100%);"></div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold mb-1">Statistik Jenis Kelamin</h5>
                                    <p class="text-muted mb-0 small">Distribusi anak berdasarkan jenis kelamin</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-3" type="button" data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Export</a></li>
                                        <li><a class="dropdown-item" href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="chartAnak" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold mb-1">Perbandingan Data</h5>
                                    <p class="text-muted mb-0 small">Perbandingan anak dan orang tua</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-3" type="button" data-bs-toggle="dropdown">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Export</a></li>
                                        <li><a class="dropdown-item" href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="chartOrangTua" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold mb-1">Aksi Cepat</h5>
                                    <p class="text-muted mb-0 small">Menu untuk akses cepat</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3 col-sm-6">
                                    <a href="{{ route('pages.data_anak') }}" class="card border-0 shadow-sm text-decoration-none h-100" style="border-radius: 12px; transition: all 0.3s ease;">
                                        <div class="card-body text-center py-4">
                                            <div class="icon-shape bg-primary-subtle rounded-3 p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                                <i class="mdi mdi-account-child fs-3 text-primary"></i>
                                            </div>
                                            <h6 class="fw-semibold text-dark mb-0">Data Anak</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <a href="{{ route('pages.penimbangan') }}" class="card border-0 shadow-sm text-decoration-none h-100" style="border-radius: 12px; transition: all 0.3s ease;">
                                        <div class="card-body text-center py-4">
                                            <div class="icon-shape bg-success-subtle rounded-3 p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                                <i class="mdi mdi-clipboard-pulse fs-3 text-success"></i>
                                            </div>
                                            <h6 class="fw-semibold text-dark mb-0">Data Posyandu</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <a href="{{ route('data_laporan.index') }}" class="card border-0 shadow-sm text-decoration-none h-100" style="border-radius: 12px; transition: all 0.3s ease;">
                                        <div class="card-body text-center py-4">
                                            <div class="icon-shape bg-warning-subtle rounded-3 p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                                <i class="mdi mdi-file-document fs-3 text-warning"></i>
                                            </div>
                                            <h6 class="fw-semibold text-dark mb-0">Laporan</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <a href="{{ route('pages.jadwal') }}" class="card border-0 shadow-sm text-decoration-none h-100" style="border-radius: 12px; transition: all 0.3s ease;">
                                        <div class="card-body text-center py-4">
                                            <div class="icon-shape bg-info-subtle rounded-3 p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                                <i class="mdi mdi-calendar-clock fs-3 text-info"></i>
                                            </div>
                                            <h6 class="fw-semibold text-dark mb-0">Jadwal</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartAnak = new Chart(document.getElementById('chartAnak'), {
                type: 'doughnut',
                data: {
                    labels: ['Anak Perempuan', 'Anak Laki-laki'],
                    datasets: [{
                        label: 'Jumlah Anak',
                        data: [{{ $jumlah_anak_perempuan }}, {{ $jumlah_anak_laki_laki }}],
                        backgroundColor: ['#e83e8c', '#0dcaf0'],
                        borderColor: ['#fff', '#fff'],
                        borderWidth: 3,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 13
                                }
                            }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            const chartOrangTua = new Chart(document.getElementById('chartOrangTua'), {
                type: 'bar',
                data: {
                    labels: ['Jumlah Anak', 'Jumlah Orang Tua'],
                    datasets: [{
                        label: 'Total',
                        data: [{{ $jumlah_anak }}, {{ $jumlah_orang_tua }}],
                        backgroundColor: ['#6610f2', '#fd7e14'],
                        borderColor: ['#6610f2', '#fd7e14'],
                        borderWidth: 0,
                        borderRadius: 8,
                        borderSkipped: false,
                        barThickness: 60
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
    <style>
        .bg-primary-subtle { background-color: #e7f1ff; }
        .bg-pink-subtle { background-color: #fce4ec; }
        .bg-info-subtle { background-color: #e7f5ff; }
        .bg-warning-subtle { background-color: #fff3cd; }
        .bg-success-subtle { background-color: #d1e7dd; }
        .text-pink { color: #e83e8c !important; }
        .text-info { color: #0dcaf0 !important; }
    </style>
@endsection
