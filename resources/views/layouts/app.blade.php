<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jewellery Shop</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Jewellery Shop</a>
            <div>
                <a class="btn btn-outline-light me-2" href="/categories">Categories</a>
                <a class="btn btn-outline-light" href="/products">Products</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
    
    <footer class="bg-dark text-white text-center mt-4 py-3">
        <p class="mb-0">&copy; {{ date('Y') }} Jewellery Shop — All rights reserved.</p>
    </footer>

    </body>
    </html>
