@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="padding: 2rem;">
                            <h4 class="card-title mb-4">Tabel Pengaturan Data Akun</h4>
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3 mb-4">
                                <a href="{{ route('pengaturanakun.create') }}"
                                    class="btn btn-primary p-2 d-flex align-items-center justify-content-center w-100 w-lg-auto"
                                    onclick="showForm()">
                                    <span class="text-light ms-2">Tambah Data Admin</span>
                                    <i class="fas fa-plus ml-2"></i>
                                </a>
                                <div class="input-group search-input-group" style="max-width: 400px; min-width: 300px;">
                                    <span class="input-group-text bg-white text-primary border-primary">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-input form-control border-start-0" id="table-search-pengaturan-akun"
                                        placeholder="Cari Nama Admin ..." autocomplete="off">
                                    <button type="button" class="btn btn-primary px-3" aria-label="Cari">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                                <table class="table text-center text-light" id="table-pengaturan-akun" style="width: 100%; min-width: 900px;">
                                    <thead>
                                        <tr>
                                            <th class="text-primary bg-light" style="width: 10%; padding: 1rem 0.5rem;">No</th>
                                            <th class="text-primary bg-light" style="width: 25%; padding: 1rem 0.5rem;">Nama Lengkap</th>
                                            <th class="text-primary bg-light" style="width: 30%; padding: 1rem 0.5rem;">Email</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Jenis Kelamin</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengaturan_akun as $item)
                                            <tr style="height: 60px;">
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $loop->iteration }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->name }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->email }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->jenis_kelamin }}</td>
                                                <td class="align-middle" style="padding: 1rem 0.5rem;">
                                                    <a class="btn btn-primary btn-sm icon-btn"
                                                        href="{{ route('pengaturanakun.edit', $item->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm icon-btn"
                                                        onclick="deleteConfirmation('{{ route('pengaturanakun.hapus', $item->id) }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {!! $pengaturan_akun->withQueryString()->links('pagination::bootstrap-5') !!}
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

        (function() {
            const searchInput = document.getElementById('table-search-pengaturan-akun');
            const table = document.getElementById('table-pengaturan-akun');
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