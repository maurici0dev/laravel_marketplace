<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace L6</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>

                @auth

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/stores')) active @endif" aria-current="page" href="{{ route('admin.stores.index') }}">Loja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/products')) active @endif" href="{{ route('admin.products.index') }}">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/orders/my')) active @endif" href="{{ route('admin.orders.index') }}">Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/categories')) active @endif" href="{{ route('admin.categories.index') }}">Categorias</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" onclick="javascript: document.querySelector('form.logout').submit();" href="#">Sair</a>
                                <form class="logout" action="{{ route('logout') }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">{{ auth()->user()->name }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                @endauth

            </div>
        </nav>
    </header>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    @yield('jsscript')
</body>
</html>
