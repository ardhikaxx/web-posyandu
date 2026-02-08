@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="padding: 2rem;">
                            <h4 class="card-title mb-4">Tabel Edukasi</h4>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a href="{{ route('edukasi.create') }}"
                                    class="btn btn-primary p-2 d-flex align-items-center justify-content-center"
                                    onclick="showForm()">
                                    <span class="text-light ms-2">Tambah Edukasi</span>
                                    <i class="fas fa-plus ml-2"></i>
                                </a>
                                <div class="input-group search-input-group" style="max-width: 400px; min-width: 300px;">
                                    <span class="input-group-text bg-white text-primary border-primary">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-input form-control border-start-0" id="table-search-edukasi"
                                        placeholder="Cari Judul Edukasi .." autocomplete="off">
                                    <button type="button" class="btn btn-primary px-3" aria-label="Cari">
                                        <span class="d-none d-lg-inline">Cari</span>
                                        <i class="fas fa-paper-plane ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                                <table class="table text-center text-light" id="table-edukasi" style="width: 100%; min-width: 1000px;">
                                    <thead>
                                        <tr>
                                            <th class="text-primary bg-light" style="width: 5%; padding: 1rem 0.5rem;">No</th>
                                            <th class="text-primary bg-light" style="width: 25%; padding: 1rem 0.5rem;">Judul</th>
                                            <th class="text-primary bg-light" style="width: 40%; padding: 1rem 0.5rem;">Isi</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Foto</th>
                                            <th class="text-primary bg-light" style="width: 15%; padding: 1rem 0.5rem;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($edukasi as $item)
                                            <tr style="height: 60px;">
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $loop->iteration }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">
                                                    {{ strlen($item->judul) > 40 ? substr($item->judul, 0, 40) . '...' : $item->judul }}
                                                </td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">
                                                    {{ substr($item->isi, 0, 60) }}{{ strlen($item->isi) > 60 ? '...' : '' }}
                                                </td>
                                                <td class="align-middle" style="padding: 1rem 0.5rem;">
                                                    @if ($item->foto)
                                                        <img src="data:image/jpeg;base64,{{ base64_encode($item->foto) }}"
                                                            alt="Edukasi Foto"
                                                            style="width: 80px; height: 80px; object-fit: cover; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 4px;">
                                                    @else
                                                        <span>Tidak ada gambar</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle" style="padding: 1rem 0.5rem;">
                                                    <a class="btn btn-primary btn-sm icon-btn"
                                                        href="{{ route('edukasi.edit', $item->id_edukasi) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm icon-btn" onclick="deleteConfirmation('{{ route('edukasi.hapus', $item->id_edukasi) }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {!! $edukasi->withQueryString()->links('pagination::bootstrap-5') !!}
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

        (function() {
            const searchInput = document.getElementById('table-search-edukasi');
            const table = document.getElementById('table-edukasi');
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