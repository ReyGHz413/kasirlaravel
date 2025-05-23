<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Kasir App')</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Earth Tone Style -->
  <style>
    body {
      background-color: #fdf6ec; /* krem alami */
      color: #4e342e;
      font-family: 'Segoe UI', sans-serif;
    }

    h1, h2, h3, h4, h5 {
      color: #5d4037;
    }

    .btn-primary {
      background-color: #a1887f;
      border-color: #8d6e63;
    }

    .btn-primary:hover {
      background-color: #8d6e63;
      border-color: #6d4c41;
    }

    .btn-warning {
      background-color: #ffb74d;
      border-color: #ffa726;
      color: #4e342e;
    }

    .btn-warning:hover {
      background-color: #ffa726;
      color: #fff;
    }

    .btn-danger {
      background-color: #d84315;
      border-color: #bf360c;
    }

    .btn-danger:hover {
      background-color: #bf360c;
    }

    .table {
      background-color: #fff8e1;
      border-color: #a1887f;
    }

    .table thead {
      background-color: #d7ccc8;
      color: #3e2723;
    }

    .alert-success {
      background-color: #dcedc8;
      color: #33691e;
      border-color: #aed581;
    }

    .navbar {
      background-color: #6d4c41;
    }

    .navbar-nav .nav-link {
      color: #ffffff !important;
    }

    .navbar-nav .nav-link:hover {
      color: #ffe0b2 !important;
    }

    .navbar-brand {
      font-weight: bold;
      color: #ffe0b2 !important;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('barang.index') }}">Kasir App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('barang.index') }}">Daftar Barang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pembelian.create') }}">Form Pembelian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('nota.index') }}">Histori Nota</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mt-4">
    @yield('content')
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
