<x-layout>
    <x-slot:title>Add Book</x-slot:title>
    <x-notiffication />
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Forms</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="title" required>
                            @error('title')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Author</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="author" required>
                            @error('author')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Publisher</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="publisher" required>
                            @error('publisher')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Synopsis</label>
                            <textarea class="form-control" id="exampleInputtext1" name="synopsis" required></textarea>
                            @error('synopsis')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Release Date</label>
                            <input type="date" class="form-control" id="exampleInputtext1" name="release_date"
                                required>
                            @error('release_date')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Read Duration</label>
                            <input type="number" min="1" class="form-control" id="exampleInputtext1" name="read_duration"
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
                                    <option class="form-control" value="{{ $item->id }}">{{ $item->name }}
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
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-layout>
