<x-layout>
    <x-slot:title>Book Suggestions</x-slot:title>
    <div class="container-fluid">
        <a href="{{route('suggest_pdf')}}" target="_blank">
            <button class="btn btn-outline-success">Generate suggestions</button>
        </a>
        <div class="card">
          <div class="card-body">
            <div class="row">
                @foreach ($suggestions as $suggest)
                <div class="col-md-4">
                  <h5 class="card-title fw-semibold mb-4">Suggest by {{$suggest->user->name}}</h5>
                  <div class="card">
                    <div class="card-header">
                        Date : {{$suggest->created_at}}
                    </div>
                    <div class="card-body">
                      <h5 class="card-title text-warning">{{$suggest->title}}</h5>
                      <h5 class="card-title">Author : {{$suggest->author}}</h5>
                      <h5 class="card-title">Publisher : {{$suggest->publisher}}</h5>
                      <p class="card-text">{{$suggest->description}}</p>
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
