@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="padding: 2rem;">
                            <h3 class="card-title mb-4">Tabel Data Imunisasi</h3>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a href="{{ route('data_imunisasi.create') }}" class="btn btn-primary p-2 d-flex align-items-center justify-content-center" onclick="showForm()">
                                    <span class="text-light ms-2">Tambah Imunisasi</span>
                                    <i class="fas fa-plus ml-2"></i>
                                </a>
                                <div class="input-group search-input-group" style="max-width: 400px; min-width: 300px;">
                                    <form action="/data-imunisasi/cari" method="GET" class="d-flex w-100">
                                        <input type="text" class="form-control border-end-0" name="cari" placeholder="Cari Nama Vaksin .." value="{{ old('cari') }}" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                        <button type="submit" class="btn btn-primary px-3" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-3" style="max-height: 500px; overflow-y: auto;">
                                <table class="table text-center text-light" style="width: 100%; min-width: 600px;">
                                    <thead>
                                        <tr>
                                            <th class="text-primary bg-light" style="width: 10%; padding: 1rem 0.5rem;">No</th>
                                            <th class="text-primary bg-light" style="width: 70%; padding: 1rem 0.5rem;">Nama Vaksin</th>
                                            <th class="text-primary bg-light" style="width: 20%; padding: 1rem 0.5rem;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_imunisasi as $item)
                                            <tr style="height: 60px;">
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $loop->iteration }}</td>
                                                <td class="text-center text-primary align-middle" style="padding: 1rem 0.5rem;">{{ $item->nama_vaksin }}</td>
                                                <td class="align-middle" style="padding: 1rem 0.5rem;">
                                                    <a class="btn btn-primary btn-sm icon-btn"
                                                        href="{{ route('data_imunisasi.edit', $item->id_vaksin) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- <a class="btn btn-danger btn-sm icon-btn"
                                                        href="{{ route('data_imunisasi.hapus', $item->id_vaksin) }}"><i
                                                            class="fas fa-trash-alt"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {!! $data_imunisasi->withQueryString()->links('pagination::bootstrap-5') !!}
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