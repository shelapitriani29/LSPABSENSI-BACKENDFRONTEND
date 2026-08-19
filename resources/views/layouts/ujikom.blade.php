<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Ujian Kompetensi - LSP SMKN 1 Garut' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f4f6f9; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            overflow-x: hidden;
            margin: 0;
        }
        .top-header-brand {
            background-color: #e9ecef;
            color: #212529;
            height: 48px;
            padding: 0 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            border-bottom: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1010;
        }
        .sidebar { 
            display: none !important;
        }
        main {
            margin-top: 48px;
            margin-left: 0 !important;
            width: 100%;
            padding: 0;
        }
        .content-area {
            width: 100%;
            margin-left: 0;
        }
    </style>
</head>
<body>
    <!-- Header Top -->
    <div class="top-header-brand">
        <span>LSP SMKN 1 GARUT</span>
    </div>

    <!-- Main Content -->
    <main role="main" class="container-fluid p-0">
        @yield('content')
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
