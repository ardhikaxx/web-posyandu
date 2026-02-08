@extends('layouts.template')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="padding: 2rem;">
                        <h4 class="card-title mb-4">Tabel Jadwal Posyandu</h4>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="{{route('jadwal_posyandu.create')}}" class="btn btn-primary p-2 d-flex align-items-center justify-content-center" onclick="showForm()">
                                <span class="text-light ms-2">Tambah Jadwal</span>
                                <i class="fas fa-plus ml-2"></i>
                            </a>
                        </div>
                        <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                            <table class="table text-center text-light" style="width: 100%; min-width: 800px;">
                                <thead>
                                    <tr>
                                        <th class="text-primary bg-light" style="width: 10%; padding: 1rem 0.5rem;">No</th>
                                        <th class="text-primary bg-light" style="width: 30%; padding: 1rem 0.5rem;">Jadwal Posyandu</th>
                                        <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Jam Buka</th>
                                        <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Jam Tutup</th>
                                        <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal_posyandu as $item)
                                        <tr style="height: 60px;">
                                            <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $loop->iteration }}</td>
                                            <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ \Carbon\Carbon::parse($item->jadwal_posyandu)->format('d-m-Y') }}</td>
                                            <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->jadwal_buka }}</td>
                                            <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->jadwal_tutup }}</td>
                                            <td class="align-middle" style="padding: 1rem 0.5rem;">
                                                <a class="btn btn-primary btn-sm icon-btn" href="{{ route('jadwal_posyandu.edit', $item->id_jadwal) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm icon-btn" onclick="deleteConfirmation('{{ route('jadwal_posyandu.hapus', $item->id_jadwal) }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>     
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {!! $jadwal_posyandu->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</script>
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
</script>
@endsection