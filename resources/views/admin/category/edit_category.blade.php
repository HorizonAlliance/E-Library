<x-layout>
    <x-slot:title>Edit Category</x-slot:title>
    <x-notiffication />
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Forms</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputCategory" class="form-label">Category Name</label>
                            <input type="name" class="form-control" id="exampleInputCategory"
                                aria-describedby="emailHelp" name="name" value="{{ old('name', $data->name) }}">
                            @error('name')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
