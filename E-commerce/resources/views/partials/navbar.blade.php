<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg bg-white shadow sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
            <i class="bi bi-bag-heart-fill text-danger"></i>
            My<span class="text-danger">Shop</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3 {{ request()->is('/') ? 'active text-danger' : 'text-dark' }}"
                       href="{{ url('/') }}">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3 {{ request()->routeIs('products.index') ? 'active text-danger' : 'text-dark' }}"
                       href="{{ route('admin.products.index') }}">
                        <i class="bi bi-grid"></i> Products
                    </a>
                </li>
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-danger rounded-pill px-4 shadow-sm {{ request()->routeIs('products.create') ? 'active' : '' }}"
                       href="{{ route('admin.products.create') }}">
                        <i class="bi bi-plus-lg"></i> Add Product
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar .nav-link { transition: color .2s ease, transform .2s ease; }
    .navbar .nav-link:hover { color: #dc3545 !important; transform: translateY(-1px); }
    .navbar .btn-danger { transition: transform .2s ease, box-shadow .2s ease; }
    .navbar .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 .5rem 1rem rgba(220,53,69,.35) !important; }
</style>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>   
