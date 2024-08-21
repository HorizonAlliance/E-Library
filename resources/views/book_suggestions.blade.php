<x-layout_frontend>
    <x-slot:title>Book Suggestion</x-slot:title>
    {{-- header --}}
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Book Suggestion</h1>
            </div>
        </div>
    </div>

    <!-- Testimonial Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <x-notiffication></x-notiffication>
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Book Suggestions</h5>
                <h1 class="mb-0">What Our Clients Say About Our Digital Services</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
                @foreach ($mostLikedSuggestions as $item)
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">{{$item->title}}</h4>
                            <div class="d-flex justify-center">
                                <form action="{{route('likeBookSuggestion')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="suggestions_id" value="{{$item->id}}">
                                    <button type="submit" name="submit" class="btn btn-outline-danger d-flex align-items-center rounded-pill">
                                        <i class="fa fa-heart me-2 text-danger"></i>
                                        <h5 class="text-danger mb-1">{{$item->suggestions_like_count}}</h5>
                                    </button>
                                </form>
                            </div>
                            <small class="text-uppercase">Author {{$item->author}}</small>
                            <small class="text-uppercase">Publisher {{$item->publisher}}</small>

                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        {{Str::limit($item->description, 100, '...')}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
        @auth
        <!-- Quote Start -->
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <div class="section-title position-relative pb-3 mb-5">
                            <h5 class="fw-bold text-primary text-uppercase">Request A Book</h5>
                            <h1 class="mb-0">Want to add a book that doesn't exist, send it here</h1>
                        </div>
                        <div class="row gx-3">
                            <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                                <h5 class="mb-4"><i class="fa fa-reply text-primary me-3"></i>Reply within 24 hours</h5>
                            </div>
                            <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                                <h5 class="mb-4"><i class="fa fa-phone-alt text-primary me-3"></i>24 hrs telephone support</h5>
                            </div>
                        </div>
                        <p class="mb-4">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                        <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                                <i class="fa fa-phone-alt text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5 class="mb-2">Call to ask any question</h5>
                                <h4 class="text-primary mb-0">+012 345 6789</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                            <form action="{{route('addBookSuggestions')}}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-xl-12">
                                        <input type="text" name="title" class="form-control bg-light border-0" placeholder="Title Book" style="height: 55px;">
                                    </div>
                                    @error('title')
                                    <p class="text-warning text-sm">{{ $message }}</p>
                                    @enderror
                                    <div class="col-12">
                                        <input type="text" name="author" class="form-control bg-light border-0" placeholder="Author (optional)" style="height: 55px;">
                                    </div>
                                    @error('author')
                                    <p class="text-warning text-sm">{{ $message }}</p>
                                    @enderror
                                    <div class="col-12">
                                        <input type="text" name="publisher" class="form-control bg-light border-0" placeholder="Publisher (optional)" style="height: 55px;">
                                    </div>
                                    @error('publisher')
                                        <p class="text-warning text-sm">{{$message}}</p>
                                    @enderror
                                    <div class="col-12">
                                        <textarea class="form-control bg-light border-0" name="description" rows="3" placeholder="Description for book (Optional)"></textarea>
                                    </div>
                                    @error('description')
                                        <p class="text-warning text-sm">{{$message}}</p>
                                    @enderror
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-dark w-100 py-3" type="submit">Request A Book</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quote End -->
        @endauth
</x-layout_frontend>
