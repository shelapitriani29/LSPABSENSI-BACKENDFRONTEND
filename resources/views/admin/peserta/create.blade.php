@extends('layouts.app')

@section('title', 'Tambah Peserta')
@section('page-title', 'Tambah Peserta')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">
        <h4 class="mb-0 fw-bold">Tambah Data Peserta</h4>
    </div>

    <div class="card-body">

        <form>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Peserta</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kelas</label>
                    <select class="form-select">
                        <option>Pilih Kelas</option>
                        <option>XII RPL 1</option>
                        <option>XII RPL 2</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Skema Sertifikasi</label>
                    <select class="form-select">
                        <option>Pilih Skema</option>
                        <option>Web Developer</option>
                        <option>UI/UX Designer</option>
                    </select>
                </div>

            </div>

            <div class="mt-4">

                <button class="btn btn-success">
                    Simpan
                </button>

                <a href="/peserta" class="btn btn-danger">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection