<x-layout_frontend>
    <x-slot:title>HomePage</x-slot:title>
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">My Collections</h1>
                <a href="" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h5 text-white">Book Detail</a>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s"
        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <div class="container py-5">
            <x-notiffication></x-notiffication>
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                        {{-- @forelse ($books as $book)
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
                        @endforelse --}}


                        {{-- versi realtions from model --}}
                        @forelse ($collections as $collect)
                        <div class="col-md-4 wow slideInUp" data-wow-delay="0.1s"
                            style="visibility: visible; animation-delay: 0.1s; animation-name: slideInUp;">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('storage/' . $collect->book->cover) }}"
                                        alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                        href="">{{ $collect->book->category->name }}
                                    </a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i
                                                class="far fa-user text-primary me-2"></i>{{ $collect->book->author }}</small>
                                        <small><i
                                                class="far fa-calendar-alt text-primary me-2"></i>{{ date('d:m:Y', strtotime($collect->book->release_date)) }}</small>
                                    </div>
                                    <h4 class="mb-3">{{ $collect->book->title }}</h4>
                                    <p>{{ $collect->book->synopsis }}</p>
                                    @include('partials.modal_book',['book' => $collect->book, 'permissions' => $permissions])
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="">
                            <h1>Books Empty</h1>
                        </div>
                    @endforelse
                    </div>
                    {{-- {{ $books->links() }} --}}
                </div>
                <!-- Blog list End -->
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
</x-layout_frontend>
