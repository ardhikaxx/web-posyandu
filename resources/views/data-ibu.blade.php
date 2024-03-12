@extends('layouts.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <h1 class="col-12 text-primary mt-4">Data Ibu</h1>
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tabel Data Ibu</h4>
                                <div class="d-flex">
                                    <input class="form-control" placeholder="Cari">
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table text-center text-light">
                                        <thead>
                                            <tr>
                                                <th class="text-light">No</th>
                                                <th class="text-light">Nama Ibu</th>
                                                <th class="text-light">Tanggal Lahir</th>
                                                <th class="text-light">Golongan darah</th>
                                                <th class="text-light">Nama Ayah</th>
                                                <th class="text-light">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td class="text-center"><strong>1</strong></td>
                                                <td class="text-center">Mimi</td>
                                                <td class="text-center">26/01/2024</td>
                                                <td class="text-center">AB</td>
                                                <td class="text-center">Pipi</td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-secondary btn-sm icon-btn"><i class="fas fa-edit"></i></a> |
                                                    <a href="" class="btn btn-danger btn-sm icon-btn"><i class="fas fa-trash-alt"></i></a>
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