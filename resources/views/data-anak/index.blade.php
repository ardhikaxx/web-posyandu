@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="padding: 2rem;">
                            <h3 class="card-title mb-4">Tabel Data Anak</h3>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="mt-1 me-3">
                                    <a href="{{ route('data_anak.create') }}" class="btn btn-primary p-2 d-flex align-items-center justify-content-center" onclick="showForm()">
                                        <span class="text-light ms-2">Tambah Data Anak</span>
                                        <i class="fas fa-plus ml-2"></i>
                                    </a>
                                </div>
                                <div class="input-group search-input-group" style="max-width: 400px; min-width: 300px;">
                                    <span class="input-group-text bg-white text-primary border-primary"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-input form-control border-start-0" id="table-search-data-anak" placeholder="Cari Nama Anak .." autocomplete="off">
                                    <button type="button" class="btn btn-primary px-3" aria-label="Cari">
                                        <span class="d-none d-lg-inline">Cari</span>
                                        <i class="fas fa-paper-plane ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                                <table class="table text-center text-light" id="table-data-anak" style="width: 100%; min-width: 1200px;">
                                    <thead>
                                        <tr>
                                            <th class="text-primary bg-light" style="width: 5%; padding: 1rem 0.5rem;">No</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">NIK Anak</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Nama Anak</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Jenis Kelamin</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Nama Ibu</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_anak as $item)
                                            <tr style="height: 60px;">
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $loop->iteration }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->nik_anak }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->nama_anak }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->jenis_kelamin_anak }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->nama_ibu }}</td>
                                                <td class="align-middle" style="padding: 1rem 0.5rem;">
                                                    <button class="btn btn-warning btn-detail btn-sm icon-btn"
                                                        data-nik_anak="{{ $item->nik_anak }}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                    <a class="btn btn-primary btn-sm icon-btn"
                                                        href="{{ route('data_anak.edit', $item->nik_anak) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm icon-btn"
                                                        onclick="deleteConfirmation('{{ route('data_anak.hapus', $item->nik_anak) }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {!! $data_anak->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function deleteConfirmation(deleteUrl) {
            Swal.fire({
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                iconColor: '#d33',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = deleteUrl;
                }
            });
        }

        $(document).on('click', '.btn-detail', function() {
            var nik_anak = $(this).data('nik_anak');
            $.ajax({
                url: '/data-anak/detail/' + nik_anak,
                method: 'GET',
                success: function(response) {
                    if (response.anak && response.ibu) {
                        var anak = response.anak;
                        var ibu = response.ibu;
                        var html = '<table class="table table-bordered">';
                        html += '<tr><th class="text-primary">Nik Anak:</th><td>' + anak.nik_anak +
                            '</td></tr>';
                        html += '<tr><th class="text-primary">Nama Anak:</th><td>' + anak.nama_anak +
                            '</td></tr>';
                        html += '<tr><th class="text-primary">Tempat Lahir Anak:</th><td>' + anak
                            .tempat_lahir_anak + '</td></tr>';
                        html += '<tr><th class="text-primary">Tanggal Lahir Anak:</th><td>' + anak
                            .tanggal_lahir_anak + '</td></tr>';
                        html += '<tr><th class="text-primary">Anak Ke:</th><td>' + anak.anak_ke +
                            '</td></tr>';
                        html += '<tr><th class="text-primary">Golongan Darah Anak:</th><td>' + anak
                            .gol_darah_anak + '</td></tr>';
                        html += '<tr><th class="text-primary">Jenis Kelamin Anak:</th><td>' + anak
                            .jenis_kelamin_anak + '</td></tr>';
                        html += '<tr><th class="text-primary">No KK:</th><td>' + anak.no_kk +
                            '</td></tr>';
                        html += '<tr><th class="text-primary">Nama Ibu:</th><td>' + ibu.nama_ibu +
                            '</td></tr>';
                        html += '<tr><th class="text-primary">Nama Ayah:</th><td>' + ibu.nama_ayah +
                            '</td></tr>';
                        html += '<tr><th class="text-primary">Alamat:</th><td>' + ibu.alamat +
                            '</td></tr>';
                        html += '</table>';

                        var swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                popup: 'swal-wide',
                                title: 'h3 text-primary'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire({
                            title: 'Detail Anak',
                            html: html,
                            showCloseButton: true,
                            showConfirmButton: false
                        });

                        $('.swal-wide').css({
                            'width': 'auto',
                            'max-width': '80%',
                            'white-space': 'normal',
                            'word-wrap': 'break-word'
                        });

                        $('.table-bordered').css({
                            'word-wrap': 'break-word',
                            'white-space': 'normal'
                        });
                    } else {
                        Swal.fire({
                            text: 'Data tidak ditemukan!',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        text: 'Terjadi kesalahan saat mengambil data!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33',
                    });
                }
            });
        });

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
            const searchInput = document.getElementById('table-search-data-anak');
            const table = document.getElementById('table-data-anak');
            if (!searchInput || !table) {
                return;
            }

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
@endsection