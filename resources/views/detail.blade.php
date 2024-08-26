<x-layout_frontend>
    <x-slot:title>Book Detail</x-slot:title>
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Book Detail</h1>
                <a href="" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h5 text-white">Book Detail</a>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s"
    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <x-notiffication></x-notiffication>
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">{{ $book->category->name }}</h5>
                    </div>
                    <h1 class="mb-0">{{ $book->title }}</h1>
                    <p class="mb-4 synopsis" style="max-width: 600px;">{{ $book->synopsis }}</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: zoomIn;">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Author : {{ $book->author }}</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Publisher : {{ $book->publisher }}</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: zoomIn;">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Release : {{ date('Y:m:d',strtotime($book->release_date)) }}</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Read Duration : {{ $book->read_duration }} Days</h5>
                        </div>
                    </div>
                    @if ($permission)
                    @if ($permission->isExpired())
                        <label class="text-warning" for="">Your permission expired on {{$permission->expirated}}!</label>
                        <form action="{{ route('request_book') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}" required>
                            <button class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" type="submit">
                                New Request
                            </button>
                        </form>
                    @else
                        @if ($permission->status == 'proces')
                            <label class="btn btn-primary" for="">In Process</label>
                        @elseif($permission->status == 'accept')
                            <button class="btn btn-primary" type="button" onclick="window.location.href='{{ route('viewPdf', ['id' => $permission->id]) }}'">
                                Approved, Read Now
                            </button>
                        @elseif($permission->status == 'decline')
                            <label class="btn btn-danger" for="">Rejected</label>
                            <form action="{{ route('request_book') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}" required>
                                <button class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" type="submit">
                                    New Request
                                </button>
                            </form>
                        @else
                            <label class="btn btn-info" for="">Unknown Status</label>
                        @endif
                    @endif
                @else
                    <form action="{{ route('request_book') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}" required>
                        <button class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" type="submit">
                            Request Permission
                        </button>
                    </form>
                @endif

                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('storage/'. $book->cover) }}" style="object-fit: cover; visibility: visible; animation-delay: 0.9s; animation-name: zoomIn;">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                    <!-- Comment List Start -->
                    <div class="mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">{{count($reviews)}} Comments</h3>
                        </div>
                        @foreach ($reviews as $review)
                        <div class="d-flex mb-4">
                            <img src="{{asset('storage/avatars/'.$review->user->avatar)}}" class="img-fluid rounded" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <div class="d-flex">
                                    <h4><i class="text-warning fas fa-star"></i> {{$review->rating}}</h4>
                                </div>
                                <h6><a href="">{{$review->user->username}}</a> <small><i>{{$review->user->created_at}}</i></small></h6>
                                <p>{{$review->ulasan}}</p>
                                {{-- <button class="btn btn-sm btn-light">Reply</button> --}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $reviews->links('pagination::bootstrap-5') }}
                    </div>
                    <!-- Comment List End -->
                    @auth
                    @if ($permission ? $permission->status == 'accept' : '')
                        <!-- Comment Form Start -->
                        <div class="bg-light rounded p-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="mb-0">Leave A Reviews</h3>
                            </div>
                            <form action="{{route('addReview')}}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    {{-- <div class="rating">
                                        <input type="radio" name="rating" id="star5" value="5">
                                        <label for="star5"><i class="fas fa-star"></i></label>

                                        <input type="radio" name="rating" id="star4" value="4">
                                        <label for="star4"><i class="fas fa-star"></i></label>

                                        <input type="radio" name="rating" id="star3" value="3">
                                        <label for="star3"><i class="fas fa-star"></i></label>

                                        <input type="radio" name="rating" id="star2" value="2">
                                        <label for="star2"><i class="fas fa-star"></i></label>

                                        <input type="radio" name="rating" id="star1" value="1">
                                        <label for="star1"><i class="fas fa-star"></i></label>
                                    </div> --}}
                                    <input type="hidden" name="book_id" value="{{$book->id}}">
                                    <div class="col-12 col-sm-6">
                                        <input type="number" min="1" max="10" name="rating" class="form-control bg-white border-0" placeholder="Your Rate 1 - 10" style="height: 55px;">
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control bg-white border-0" name="ulasan" rows="5" placeholder="Write your Review"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Leave Your Reviews</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Comment Form End -->
                    @else
                        <h4 class="text-warning">Request Book to Add Ratings</h4>
                    @endif

                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-layout_frontend>
