<x-layout>
    <x-slot:title>Edit Book</x-slot:title>
    <x-notiffication />
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Forms</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="title" required
                                value="{{ old('title', $book->title) }}">
                            @error('title')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Author</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="author" required
                                value="{{ old('author', $book->author) }}">
                            @error('author')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Publisher</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="publisher" required
                                value="{{ old('publisher', $book->publisher) }}">
                            @error('publisher')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Synopsis</label>
                            <textarea class="form-control" id="exampleInputtext1" name="synopsis" required>{{ old('synopsis', $book->synopsis) }}</textarea>
                            @error('synopsis')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Tanggal Rilis</label>
                            <input type="date" class="form-control" id="exampleInputtext1" name="release_date"
                                required
                                value="{{ old('release_date', $book->release_date ? date('Y-m-d', strtotime($book->release_date)) : '') }}">
                            @error('release_date')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Read Duration</label>
                            <input type="number" min="1" class="form-control" id="exampleInputtext1" name="read_duration" value="{{ $book->read_duration }}"
                                required>
                            @error('read_duration')
                                <div id="readHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option>Chose Category</option>
                                @foreach ($category as $item)
                                    <option class="form-control"
                                        {{ $item->id == $book->category_id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">cover</label>
                            <input type="file" class="form-control" id="exampleInputtext1" name="cover">
                            @error('cover')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">file PDF</label>
                            <input type="file" class="form-control" id="exampleInputtext1" name="file">
                            @error('file')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                <button type="submit" class="btn btn-primary">update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-layout>
