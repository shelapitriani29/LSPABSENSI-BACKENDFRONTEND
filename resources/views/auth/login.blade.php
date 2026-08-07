@extends('layouts.auth')

@section('title', 'Login - TEFA LSP & ABSENSI')

@section('content')

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
    display:flex;
    justify-content:center;
    align-items:center;
    overflow-x:hidden;
    position:relative;
}

body::before{
    content:'';
    position:absolute;
    width:420px;
    height:420px;
    border-radius:50%;
    background:rgba(13, 110, 253, 0.10);
    top:-160px;
    right:-140px;
    pointer-events:none;
}

body::after{
    content:'';
    position:absolute;
    width:320px;
    height:320px;
    border-radius:50%;
    background:rgba(16, 185, 129, 0.12);
    bottom:-140px;
    left:-120px;
    pointer-events:none;
}

.login-wrapper{
    width:100%;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    padding:20px;
    position:relative;
    z-index:10;
}

.login-card{
    width:100%;
    max-width:440px;
    background:#fff;
    border-radius:24px;
    padding:40px 35px;
    box-shadow:0 18px 40px rgba(30, 55, 87, 0.12);
    position:relative;
    overflow:hidden;
}

.login-card::before{
    content:'';
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:radial-gradient(circle, rgba(13, 110, 253, 0.14), transparent 55%);
    top:-90px;
    left:-90px;
    pointer-events:none;
}

.logo{
    width:80px;
    height:80px;
    background:linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    color:#fff;
    font-size:32px;
    margin-bottom:14px;
    box-shadow:0 12px 24px rgba(13, 110, 253, 0.25);
}

.logo i{
    font-size:1.65rem;
}

.logo-text{
    text-align:center;
    margin-bottom:18px;
    font-size:13px;
    font-weight:600;
    color:#0d6efd;
    letter-spacing:0.8px;
    text-transform:uppercase;
}

h2{
    text-align:center;
    font-weight:700;
    font-size:22px;
    color:#1e293b;
    margin-bottom:6px;
    letter-spacing: 0.3px;
}

.subtitle{
    text-align:center;
    color:#64748b;
    margin-bottom:24px;
    font-size:14px;
    font-weight:500;
}

.form-label{
    font-weight:500;
    color:#475569;
    margin-bottom:6px;
    font-size:13px;
    display:block;
}

.input-group{
    display:flex;
    width:100%;
    margin-bottom:16px;
}

.input-group-text{
    width:56px;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#eef5ff;
    border:1px solid #cbd5e1;
    border-right:none;
    border-radius:12px 0 0 12px;
    color: #0d6efd;
}

.input-group-text .icon-box{
    width:34px;
    height:34px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#fff;
    border-radius:50%;
    box-shadow:0 5px 14px rgba(13, 110, 253, 0.12);
}

.input-group-text i{
    font-size:1.05rem;
}

.form-control{
    flex:1;
    width:100%;
    border:1px solid #cbd5e1;
    border-left:none;
    background:#fff;
    border-radius:0 12px 12px 0;
    padding:11px 14px;
    font-size:14px;
    color: #1e293b;
}

.form-control::placeholder {
    color: #94a3b8;
}

.form-control:focus{
    outline:none;
    background:#fff;
    border-color:#0d6efd;
    box-shadow:0 0 0 3px rgba(13, 110, 253, 0.12);
}

.option-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
}

.form-check{
    display:flex;
    align-items:center;
    gap:8px;
}

.form-check-input{
    margin:0;
    border-color: #cbd5e1;
    width: 17px;
    height: 17px;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-check-label{
    font-size:14px;
    color: #475569;
}

.forgot{
    text-decoration:none;
    font-size:14px;
    color:#0d6efd;
    font-weight:500;
}

.forgot:hover{
    text-decoration:underline;
}

.btn-login{
    width:100%;
    border:none;
    background:#0d6efd;
    color:#fff;
    padding:12px;
    border-radius:12px;
    font-weight:600;
    font-size:15px;
    transition:.3s;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
}

.btn-login:hover{
    background:#0b5ed7;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(13, 110, 253, 0.3);
}

.copyright{
    text-align:center;
    margin-top:20px;
    color:#64748b;
    font-size:13px;
    font-weight:500;
}

@media(max-width:576px){
    .login-card{
        padding:30px 20px;
    }
    .option-row{
        flex-direction:column;
        gap:12px;
        align-items:flex-start;
    }
}
</style>

<div class="login-wrapper">

    <div class="login-card">

        <div class="logo">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <div class="logo-text">TEFA LSP & ABSENSI</div>

        <h2>Selamat Datang Kembali</h2>

        <div class="subtitle">
            Silakan masuk ke akun Anda
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4 py-2 px-3 small d-flex align-items-center justify-content-between rounded-3" role="alert" style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <label class="form-label">
                Username / Email
            </label>

            <div class="input-group">
                <span class="input-group-text">
                    <span class="icon-box"><i class="bi bi-person"></i></span>
                </span>

                <input
                    type="text"
                    name="username"
                    class="form-control @error('username') is-invalid @enderror"
                    placeholder="Masukkan Username"
                    value="{{ old('username') }}"
                    required>
            </div>

            @error('username')
                <div class="text-danger mb-3 small" style="margin-top: -10px;">
                    {{ $message }}
                </div>
            @enderror

            <label class="form-label">
                Password
            </label>

            <div class="input-group">
                <span class="input-group-text">
                    <span class="icon-box"><i class="bi bi-lock"></i></span>
                </span>

                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan Password"
                    required>
            </div>

            @error('password')
                <div class="text-danger mb-3 small" style="margin-top: -10px;">
                    {{ $message }}
                </div>
            @enderror

            <div class="option-row">

                <div class="form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="remember"
                        name="remember">

                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <a href="#" class="forgot">
                    Lupa Password?
                </a>

            </div>

            <button type="submit" class="btn-login">
                <span>Masuk</span>
                <i class="bi bi-arrow-right"></i>
            </button>

        </form>

    </div>

    <div class="copyright">
        &copy; {{ date('Y') }} SMKN 1 Garut.
    </div>

</div>

@endsection