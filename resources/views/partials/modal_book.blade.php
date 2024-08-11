<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $book->id }}">
    Read More
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="card-title fw-semibold mb-4">{{ $book->title }}</h5>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Synopsis : {{ $book->synopsis }}</p>
                        <p class="card-text">Author : {{ $book->author }}</p>
                        <p class="card-text">Publisher : {{ $book->publisher }}</p>
                        <p class="card-text">Release date : {{ $book->publisher }}</p>
                        <p class="card-text">Category : {{ $book->category['name'] }}</p>
                        <p class="card-text">Read Duration : {{ $book->read_duration }} days</p>
                        @php
                        $permission = null;
                        if (!is_null($permissions)) {
                            $permission = $permissions->firstWhere('book_id', $book->id);
                        }
                        @endphp
                        @if ($permission)
                            @if ($permission->status == 'proces')
                                <label class="btn btn-primary" for="">In Process</label>
                            @elseif($permission->status == 'accept')
                            <button class="btn btn-primary" type="button" onclick="window.location.href='{{ route('viewPdf', ['id' => $permission->id]) }}'">
                                Approved, ReadNow
                            </button>
                            @elseif($permission->status == 'decline')
                                <label class="btn btn-danger" for="">Rejected</label>
                            @elseif($permission->status == 'expirated')
                                <label class="btn btn-warning" for="">Expirated</label>
                            @else
                                <label class="btn btn-info" for="">Unkn own Status</label>
                            @endif
                        @else
                            <form action="{{ route('request_book') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}" required>
                                <button class="btn btn-primary" type="submit">
                                    Request Permissions
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
