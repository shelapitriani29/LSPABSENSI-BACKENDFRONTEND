@extends('layouts.app')

@section('title', 'Data Peserta')
@section('page-title', 'Data Peserta')

@section('content')

<div class="row mb-4 align-items-center">

    <div class="col-md-6">
        <h4 class="fw-bold mb-1">Data Peserta</h4>
        <small class="text-muted">
            Kelola seluruh data peserta sertifikasi.
        </small>
    </div>

    <div class="col-md-6 text-end">
        <a href="/peserta/create" class="btn btn-success">
            + Tambah Peserta
        </a>
    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row mb-3">

    <div class="col-md-8">
        <input
            type="text"
            class="form-control"
            placeholder="🔍 Cari peserta...">
    </div>

    <div class="col-md-4">
        <select class="form-select">
            <option>Semua Kelas</option>
            <option>XII RPL 1</option>
            <option>XII RPL 2</option>
        </select>
    </div>

</div>

        <table class="table table-hover align-middle">

            <thead class="table-light">

                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Skema</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>Andi Saputra</td>
                    <td>231001</td>
                    <td>XII RPL 1</td>
                    <td>Web Developer</td>
                    <td>

    <a href="/peserta/edit" class="btn btn-warning btn-sm">
        Edit
    </a>

    <button class="btn btn-danger btn-sm">
        Hapus
    </button>

</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Budi Santoso</td>
                    <td>231002</td>
                    <td>XII RPL 2</td>
                    <td>UI/UX Designer</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>

            </tbody>

        </table>

        <nav class="mt-4">

    <ul class="pagination justify-content-end">

        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>

        <li class="page-item active">
            <a class="page-link" href="#">1</a>
        </li>

        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>

        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>

    </ul>

</nav>

    </div>

</div>

@endsection