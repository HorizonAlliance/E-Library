<x-layout>
    <x-slot:title>Book Review</x-slot:title>
    <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="row">
                @foreach ($reviews as $review)
                <div class="col-md-4">
                  <h5 class="card-title fw-semibold mb-4">Review by {{$review->user->name}}</h5>
                  <div class="card">
                    <div class="card-header">
                        Date : {{$review->created_at}}
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <i class="ti ti-star fs-4 text-warning"></i>
                          <h5 class="card-title text-warning">{{$review->rating}}</h5>
                        </div>
                      <p class="card-text">{{$review->ulasan}}</p>
                      {{-- <a href="#" class="btn btn-primary">See more</a> --}}
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
</x-layout>
