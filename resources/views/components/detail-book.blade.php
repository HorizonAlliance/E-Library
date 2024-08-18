<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $book->id }}">
    Details
</button>
<div class="modal fade" id="exampleModal-{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-body">
                    <h5 class="card-title text-2xl">Title : {{ $book->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Author : {{ $book->author }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">publisher : {{ $book->publisher }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">category : {{ $book->category['name'] }}</h6>
                    <p class="card-text">{{ $book->synopsis }}</p>
                    <a href="#" class="card-link">Read Review</a>
                </div>
            </div>
        </div>
    </div>
</div>
