    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.html" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>Startup</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Book Request</a>
                        <div class="dropdown-menu m-0">
                            <a href="blog.html" class="dropdown-item">book approved</a>
                            <a href="detail.html" class="dropdown-item">finished reading</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Collections</a>
                        <div class="dropdown-menu m-0">
                            <a href="quote.html" class="dropdown-item">Free Quote</a>
                        </div>
                    </div>
                    <a href="{{ asset('frontend/') }}contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal"
                    data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
                @if (auth()->user())
                <form action="{{route('logout')}}" onsubmit="return confirm('are you sure!')" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary py-2 px-4 ms-3">Logout</button>
                </form>
                @else
                <a href="{{route('login')}}"
                class="btn btn-primary py-2 px-4 ms-3">Login</a>
                @endif

            </div>
        </nav>

    </div>
    <!-- Navbar & Carousel End -->
