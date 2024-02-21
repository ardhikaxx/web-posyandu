@extends('layouts.template')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <h1 class="col-12 text-primary mt-4">Data Imunisasi</h1>
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tabel Data Imunisasi</h4>
                            <div class="d-flex">
                                <a href="#" class="btn btn-light"><span class="text-primary">Tambah Data Vaksin</span></a>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table text-center text-light">
                                    <thead>
                                        <tr>
                                            <th class="text-light">No</th>
                                            <th class="text-light">Id Vaksin</th>
                                            <th class="text-light">Nama Vaksin</th>
                                            <th class="text-light">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td class="text-center"><strong>1</strong></td>
                                            <td class="text-center">Yanuar Ardhika</td>
                                            <td class="text-center">Mimi</td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-primary btn-sm">Edit</a> |
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection