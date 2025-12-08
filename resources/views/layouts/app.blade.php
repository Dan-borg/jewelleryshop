<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blush Boutique Jewellery</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #FFF5F7; /* very light pink */
            color: #3A3A3A;
        }

        .navbar-blush {
            background: linear-gradient(90deg, #FAD4D8, #F7E7EA);
        }

        .navbar-blush .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #3A3A3A;
        }

        .navbar-blush .nav-link {
            color: #3A3A3A;
            font-weight: 500;
        }

        .btn-blush {
            background-color: #FAD4D8;
            border-color: #FAD4D8;
            color: #3A3A3A;
        }

        .btn-blush:hover {
            background-color: #F7C3CC;
            border-color: #F7C3CC;
            color: #3A3A3A;
        }

        .hero-blush {
            background: linear-gradient(135deg, #FAD4D8, #F7E7EA);
            border-radius: 1.5rem;
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .hero-blush h1 {
            font-size: 2.2rem;
            font-weight: 700;
        }

        .hero-blush p {
            font-size: 1rem;
            margin-top: 0.75rem;
        }

        footer {
            background-color: #F7E7EA;
            color: #3A3A3A;
            margin-top: 3rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-blush mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Blush Boutique Jewellery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="mainNav" class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/shop">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="/categories">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="/collections">Collections</a></li>
                <li class="nav-item"><a class="nav-link" href="/metal-types">Metal Types</a></li>
            </ul>

        </div>
    </div>
</nav>

<div class="container">
    @include('partials.alerts')
    @yield('content')
</div>

<footer class="py-3 text-center">
    <small>&copy; {{ date('Y') }} Blush Boutique Jewellery · Handcrafted with love.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
