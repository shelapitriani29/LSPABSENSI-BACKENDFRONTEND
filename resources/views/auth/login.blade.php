@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="login-page">

    <div class="login-card">

        <div class="text-center mb-4">

            <div class="logo"></div>

            <h2>TEFA LSP & ABSENSI</h2>

            <p>Silakan login untuk melanjutkan</p>

        </div>

        <form>

            {{-- Username --}}
            <div class="mb-3">

                <label class="form-label">
                    Username
                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan Username">

            </div>

            {{-- Password --}}
            <div class="mb-3">

                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    class="form-control"
                    placeholder="Masukkan Password">

            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember">

                    <label
                        class="form-check-label"
                        for="remember">

                        Remember Me

                    </label>

                </div>

                <a href="#">

                    Lupa Password?

                </a>

            </div>

            <button
                class="btn btn-primary w-100">

                Login

            </button>

        </form>

    </div>

</div>

@endsection