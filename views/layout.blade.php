<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Ecommerce - Thiết Bị Điện Tử')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Arial', sans-serif;  }
        .navbar { background-color: #007bff; }
        .navbar-brand, .nav-link { color: black !important; }
        .product-card { border: none; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .product-card:hover { transform: scale(1.05); }
        .product-img { height: 200px; object-fit: contain; }
        .banner { background: url('https://cdn-media.sforum.vn/storage/app/media/ctv_seo8/chuong-trinh-khuyen-mai/chuong-trinh-khuyen-mai-thumbnail.jpg') no-repeat center; height: 400px; color: black; text-align: center; padding-top: 150px; }
        .banner h1 { font-size: 3rem; }
        .footer { background-color: #343a40; color: white; padding: 20px 0; }
        .tab-content .tab-pane { padding: 20px 0; }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">Thiết Bị Điện Tử FPT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/products">Sản Phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="/cart">Giỏ Hàng (@if (!empty($_SESSION['cart'])) {{ array_sum($_SESSION['cart']) }} @else 0 @endif)</a></li>
                    @if (!empty($_SESSION['user']))
                        <li class="nav-item"><a class="nav-link" href="/orders">Đơn Hàng</a></li>
                        @if ($_SESSION['user']['type'] == 'admin')
                            <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
                        @endif
                    @endif
                </ul>
                <form class="d-flex me-3">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <ul class="navbar-nav">
                    @if (empty($_SESSION['user']))
                        <li class="nav-item"><a class="nav-link" href="/auth/login">Đăng Nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="/auth/register">Đăng Ký</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="/auth/logout">Đăng Xuất ({{ $_SESSION['user']['name'] }})</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (!empty($_SESSION['errors']))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($_SESSION['errors'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <?php unset($_SESSION['errors']); ?>
        @endif

        @if (!empty($_SESSION['success']))
            <div class="alert alert-success">{{ $_SESSION['success'] }}</div>
            <?php unset($_SESSION['success']); ?>
        @endif

        @yield('content')
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về Chúng Tôi</h5>
                    <p>Ecommerce chuyên bán thiết bị điện tử chất lượng cao.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên Hệ</h5>
                    <p>Email: support@ecommerce.com</p>
                    <p>Phone: 0123 456 789</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo Dõi Chúng Tôi</h5>
                    <a href="#" class="text-white"><i class="bi bi-facebook me-2"></i>Facebook</a><br>
                    <a href="#" class="text-white"><i class="bi bi-instagram me-2"></i>Instagram</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>