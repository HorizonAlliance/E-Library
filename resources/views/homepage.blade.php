<x-layout_frontend>
    <x-slot:title>HomePage</x-slot:title>
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('frontend/img/carousel-1.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Digital Library</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">increase your knowledge</h1>
                            <a href=""
                                class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">
                                @guest
                                    Welcome....
                                @else
                                    Welcome {{auth()->user()->username}}
                                @endguest
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('frontend/img/carousel-2.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Digital Library</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Your library, now in your hands</h1>
                            <a href=""
                            class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">
                            @guest
                                Welcome....
                            @else
                                Welcome {{auth()->user()->username}}
                            @endguest
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container-fluid facts py-5 pt-lg-0">
            <div class="container py-5 pt-lg-0">
                <div class="row gx-0">
                    <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
                        <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                            <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                                <i class="fa fa-users text-primary"></i>
                            </div>
                            <div class="ps-4">
                                <h5 class="text-white mb-0">Member</h5>
                                <h1 class="text-white mb-0" data-toggle="counter-up">{{$userCount}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: zoomIn;">
                        <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                            <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                                <i class="fa fa-book text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5 class="text-primary mb-0">Books</h5>
                                <h1 class="mb-0" data-toggle="counter-up">{{$booksCount}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: zoomIn;">
                        <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                            <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                                <i class="fa fa-check text-primary"></i>
                            </div>
                            <div class="ps-4">
                                <h5 class="text-white mb-0">Request Books</h5>
                                <h1 class="text-white mb-0" data-toggle="counter-up">{{$requestCount}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- list book --}}
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s"
        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <div class="container py-5">
            <x-notiffication></x-notiffication>
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                        @forelse ($books as $book)
                            <div class="col-md-4 col-sm-6 wow slideInUp" data-wow-delay="0.1s"
                                style="visibility: visible; animation-delay: 0.1s; animation-name: slideInUp;">
                                <div class="blog-item bg-light rounded overflow-hidden">
                                    <div class="blog-img position-relative overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('storage/' . $book->cover) }}"
                                            alt="">
                                        <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                            href="">{{ $book->category->name }}</a>
                                    </div>
                                    <div class="p-4">
                                        <div class="d-flex mb-3">
                                            <small class="me-3"><i
                                                    class="far fa-user text-primary me-2"></i>{{ $book->author }}</small>
                                            <small><i
                                                    class="far fa-calendar-alt text-primary me-2"></i>{{ date('d:m:Y', strtotime($book->release_date)) }}</small>
                                        </div>
                                        <h4 class="mb-3">{{ $book->title }}</h4>
                                        <p class="mb-4">{{ $book->synopsis }}</p>
                                        <div class="d-flex mb-3">
                                            {{-- @include('partials.modal_book',['book' => $book, 'permissions' => $permissions]) --}}
                                        <form action="{{route('addCollect')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{$book->id}}">
                                            <button type="submit" class="btn btn-warning"> + AddToCollect</button>
                                        </form>
                                        <a href="{{route('book_detail',$book->id)}}">
                                            <button class="btn btn-info">Read More</button>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="">
                                <h1>Books Empty</h1>
                            </div>
                        @endforelse
                    </div>
                    {{ $books->links() }}
                </div>
                <!-- Blog list End -->
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
</x-layout_frontend>
