<!-- navbar -->
<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a href="{{ route('home') }} " class="navbar-brand">
            <img src="{{ url('assets/image/logo.png') }} " alt="logo NOMADS">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item mx-md-2">
                    <div class="nav-link active">Home</div>
                </li>
                <li class="nav-item mx-md-2">
                    <div class="nav-link">Paket Travel</div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop"
                        data-toggle="dropdown">Services</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Link</a>
                        <a href="#" class="dropdown-item">Link</a>
                        <a href="#" class="dropdown-item">Link</a>
                    </div>
                </li>
                <li class="nav-item mx-md-2">
                    <div class="nav-link">Testimonial</div>
                </li>
            </ul>


            @guest
                <!-- mobile button -->
                <form action="" class="form-inline d-sm-block d-md-none">
                    <button type="button" class="btn btn-login my-2 my-sm-0" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}; '">
                        Masuk
                    </button>
                </form>

                <!-- desktop button -->

                <form action="" class="form-inline my-2 my-lg-0 d-none d-md-block">
                    <button type="button" class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }} '">
                        Masuk
                    </button>
                @endguest

                @auth
                    <!-- mobile button -->
                    <form action="{{ url('logout') }}" method="POST" class="form-inline d-sm-block d-md-none">
                        @csrf
                        <button class="btn btn-login my-2 my-sm-0" type="submit">
                            Keluar
                        </button>
                    </form>

                    <!-- desktop button -->

                    <form action="{{ url('logout') }}" method="POST" class="form-inline my-2 my-lg-0 d-none d-md-block">
                        @csrf
                        <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                            Keluar
                        </button>
                    @endauth
                </form>
        </div>
    </nav>
</div>
