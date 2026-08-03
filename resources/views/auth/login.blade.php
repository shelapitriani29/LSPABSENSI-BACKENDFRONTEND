<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TEFA LSP & ABSENSI</title>
    
    <!-- Load CSS via Vite & Bootstrap Icons -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .input-with-icon {
            border-left: none;
        }
        .btn-primary-custom {
            background-color: #0d6efd;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary-custom:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>

    <!-- Wrapper Layar Penuh -->
    <div class="min-vh-100 d-flex flex-column align-items-center justify-content-center p-3">
        
        <!-- Card Login -->
        <div class="card border-0 bg-white p-4 p-sm-5 login-card">
            
            <!-- Header Logo & Judul -->
            <div class="text-center mb-4">
                <!-- Icon/Logo Container -->
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-gradient text-white rounded-circle mb-3 shadow-sm" style="width: 64px; height: 64px;">
                    <i class="bi bi-shield-lock-fill fs-3"></i>
                </div>
                
                <h4 class="fw-bold text-dark mb-1" style="letter-spacing: 0.5px;">TEFA LSP & ABSENSI</h4>
                <small class="text-secondary fw-medium">Silakan masuk ke akun Anda</small>
            </div>

            <!-- Form Login -->
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Input Username dengan Icon -->
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-medium mb-1">Username</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted border-secondary-subtle" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-person fs-6"></i>
                        </span>
                        <input type="text" name="username" class="form-control input-with-icon border-secondary-subtle py-2 fs-6" placeholder="Masukkan Username" required style="border-radius: 0 10px 10px 0;">
                    </div>
                </div>

                <!-- Input Password dengan Icon -->
                <div class="mb-3">
                    <label class="form-label text-secondary small fw-medium mb-1">Password</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted border-secondary-subtle" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-lock fs-6"></i>
                        </span>
                        <input type="password" name="password" class="form-control input-with-icon border-secondary-subtle py-2 fs-6" placeholder="Masukkan Password" required style="border-radius: 0 10px 10px 0;">
                    </div>
                </div>

                <!-- Remember Me & Lupa Password -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label small text-muted" for="remember">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-primary text-decoration-none small fw-medium">Lupa Password?</a>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" class="btn btn-primary-custom text-white w-100 d-flex align-items-center justify-content-center gap-2">
                    <span>Masuk</span>
                    <i class="bi bi-arrow-right-short fs-5"></i>
                </button>
            </form>

        </div>

        <!-- Footer Copyright -->
        <div class="text-center mt-4">
            <small class="text-muted fw-medium">&copy; {{ date('Y') }} SMKN 1 Garut.</small>
        </div>

    </div>

</body>
</html>