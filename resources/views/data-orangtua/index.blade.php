@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="padding: 2rem;">
                            <h3 class="card-title mb-4">Tabel Data Orang Tua</h3>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="input-group search-input-group" style="max-width: 400px; min-width: 300px;">
                                    <span class="input-group-text bg-white text-primary border-primary"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-input form-control border-start-0" id="table-search-data-orangtua" placeholder="Cari Nama Ibu .." autocomplete="off">
                                    <button type="button" class="btn btn-primary px-3" aria-label="Cari"><span class="d-none d-lg-inline">Cari</span><i class="fas fa-paper-plane ms-1"></i></button>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                                <table class="table text-center text-light" id="table-data-orangtua" style="width: 100%; min-width: 1000px;">
                                    <thead>
                                        <tr>
                                            <th class="text-primary bg-light" style="width: 5%; padding: 1rem 0.5rem;">No</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">NO KK</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Nama Ibu</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Nama Ayah</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Telepon</th>
                                            <th class="text-primary bg-light" style="width: 25%; padding: 1rem 0.5rem;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_ibu as $item)
                                            <tr style="height: 60px;">
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $loop->iteration }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->no_kk }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->nama_ibu }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->nama_ayah }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->telepon }}</td>
                                                <td class="align-middle" style="padding: 1rem 0.5rem;">
                                                    <a class="btn btn-primary btn-sm icon-btn" href="{{ route('data_ibu.edit', $item->no_kk) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-warning btn-detail btn-sm icon-btn" data-no_kk="{{ $item->no_kk }}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {!! $data_ibu->withQueryString()->links('pagination::bootstrap-5') !!}
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
                title: 'Apakah Anda yakin ingin menghapus data ini?',
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
    </script>
    <script>
        $(document).on('click', '.btn-detail', function() {
            var no_kk = $(this).data('no_kk');
            $.ajax({
                url: '/data-orangtua/detail/' + no_kk,
                method: 'GET',
                success: function(response) {
                    if (response) {
                        var html = '<table class="table table-bordered">';
                        html += '<tr><th class="text-primary">Nomor KK:</th><td>' + response.no_kk + '</td></tr>';
                        html += '<tr><th class="text-primary">NIK Ibu:</th><td>' + response.nik_ibu + '</td></tr>';
                        html += '<tr><th class="text-primary">Nama Ibu:</th><td>' + response.nama_ibu + '</td></tr>';
                        html += '<tr><th class="text-primary">Tempat Lahir Ibu:</th><td>' + response.tempat_lahir_ibu + '</td></tr>';
                        html += '<tr><th class="text-primary">Tanggal Lahir Ibu:</th><td>' + response.tanggal_lahir_ibu + '</td></tr>';
                        html += '<tr><th class="text-primary">Golongan Darah Ibu:</th><td>' + response.gol_darah_ibu + '</td></tr>';
                        html += '<tr><th class="text-primary">NIK Ayah:</th><td>' + response.nik_ayah + '</td></tr>';
                        html += '<tr><th class="text-primary">Nama Ayah:</th><td>' + response.nama_ayah + '</td></tr>';
                        html += '<tr><th class="text-primary">Alamat:</th><td>' + response.alamat + '</td></tr>';
                        html += '<tr><th class="text-primary">Telepon:</th><td>' + response.telepon + '</td></tr>';
                        html += '<tr><th class="text-primary">Email Orang Tua:</th><td>' + response.email_orang_tua + '</td></tr>';
                        html += '</table>';

                        var swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                popup: 'swal-wide',
                                title: 'h3 text-primary'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire({
                            title: 'Detail Orang Tua',
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

        (function() {
            const searchInput = document.getElementById('table-search-data-orangtua');
            const table = document.getElementById('table-data-orangtua');
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

        @if(session('success'))
            Swal.fire({
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
        @endif

        @if(session('info'))
            Swal.fire({
                text: '{{ session('info') }}',
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
        @endif
    </script>
@endsection