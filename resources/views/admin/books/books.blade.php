<x-layout>
    <x-slot:title>Books</x-slot:title>
    <x-notiffication />
    <div class="card">
        <div class="d-flex">
            <a href="{{ route('books.create') }}">
                <button type="button" class="btn btn-primary m-1">Add Book</button>
            </a>
            <a href="{{ route('books_pdf') }}" target="_blank">
                <button type="button" class="btn btn-outline-success m-1">Generate Most Request Books</button>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4">
                        <h5 class="card-title fw-semibold mb-4">{{ $book->title}}</h5>
                        <div class="card">
                            <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->author }}</h5>
                                <p class="card-text">{{ Str::limit($book->synopsis , 100, '...')}}</p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <x-detail-book :book="$book"></x-detail-book>
                                    <a href="{{ route('books.edit', $book->id) }}">
                                        <button class="btn btn-warning" type="button">Edit</button>
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" type="button">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $books->links() }}
        </div>
    </div>
</x-layout>
