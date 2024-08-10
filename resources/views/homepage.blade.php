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
                                class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('frontend/img/carousel-2.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Digital Library</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Your library, now in your hands</h1>
                            <a href="{{ asset('frontend/') }}quote.html"
                                class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
                            <a href="{{ asset('frontend/') }}"
                                class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
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
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s"
        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <div class="container py-5">
            <x-notiffication></x-notiffication>
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                        @forelse ($books as $book)
                            <div class="col-md-4 wow slideInUp" data-wow-delay="0.1s"
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
                                        <p>{{ $book->synopsis }}</p>
                                        @include('partials.modal_book',['book' => $book, 'permissions' => $permissions])
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
