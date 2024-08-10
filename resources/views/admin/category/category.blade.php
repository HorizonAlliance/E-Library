<x-layout>
    <x-slot:title>Category</x-slot:title>
    <x-notiffication />
    <div class="row">
        <a href="{{ route('category.create') }}">
            <button type="button" class="btn btn-primary m-1">Add Category</button>
        </a>
        <div class="col-lg-12  d-flex align-items-stretch">
            <div class="card ">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Category Broo</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Category</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $data)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $data->name }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4">
                                                <a href="{{ route('category.edit', $data->id) }}">
                                                    <button type="button" class="btn btn-primary m-1">Edit</button>
                                                </a>
                                                <form onsubmit="return confirm('apakah lo yakin?')"
                                                    action="{{ route('category.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary m-1">Delete</button>
                                                </form>
                                            </h6>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
