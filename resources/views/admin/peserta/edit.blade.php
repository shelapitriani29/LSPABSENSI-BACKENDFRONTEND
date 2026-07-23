@extends('layouts.app')

@section('title', 'Edit Peserta')
@section('page-title', 'Edit Peserta')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">
        <h4 class="mb-0 fw-bold">Edit Data Peserta</h4>
    </div>

    <div class="card-body">

        <form>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Peserta</label>
                    <input type="text"
                           class="form-control"
                           value="Andi Saputra">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text"
                           class="form-control"
                           value="231001">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Kelas</label>

                    <select class="form-select">

                        <option>XII RPL 1</option>
                        <option>XII RPL 2</option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Skema Sertifikasi
                    </label>

                    <select class="form-select">

                        <option>Web Developer</option>
                        <option>UI / UX Designer</option>

                    </select>

                </div>

            </div>

            <div class="mt-4">

                <button class="btn btn-primary">

                    Simpan Perubahan

                </button>

                <a href="/peserta"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection