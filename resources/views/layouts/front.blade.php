<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

        <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>

                @foreach($categories as $category)
                <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                    <a class="nav-link" href="{{route('single.category', ['slug' => $category->slug])}}">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>

            <div class="my-2 my-lg-0">
                <ul class="navbar-nav">

                    @auth
                    <li class="nav-item">
                        <a href="{{ route('user.orders') }}" class="nav-link @if(request()->is('orders')) active @endif">Meus pedidos</a>
                    </li>
                    @endauth

                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            @if(session()->has('cart'))
                            <span class="badge badge-danger">{{ count(session()->get('cart')) }}</span>
                            @endif
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    @yield('scripts')
</body>
</html>
