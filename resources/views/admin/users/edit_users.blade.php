<x-layout>
    <x-slot:title>Add Users</x-slot:title>
    <x-notiffication />
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Forms</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" readonly
                                value="{{ old('email', $user->email) }}" aria-describedby="emailHelp" name="email">
                            @error('email')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="username" required
                                value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror

                            <label for="exampleInputEmail1" class="form-label">name</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="name" required
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror

                            <label for="exampleInputEmail1" class="form-label">address</label>
                            <input type="text" class="form-control" id="exampleInputtext1" name="address" required
                                value="{{ old('address', $user->address) }}">
                            @error('address')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror
                            <label for="exampleInputEmail1" class="form-label">avatar</label>
                            <input type="file" class="form-control" id="exampleInputtext1" name="avatar">
                            @error('avatar')
                                <div id="emailHelp" class="form-text text-warning">{{ $message }}</div>
                            @enderror

                            <label for="exampleInputEmail1" class="form-label">role</label>
                            <select name="role" id="" class="form-control">
                                <option>Chose Role</option>
                                <option class="form-control" {{ $user->role == 'admin' ? 'selected' : '' }}
                                    value="admin">Admin</option>
                                <option class="form-control" {{ $user->role == 'librarian' ? 'selected' : '' }}
                                    value="librarian">Librarian</option>
                                <option class="form-control" {{ $user->role == 'reader' ? 'selected' : '' }}
                                    value="reader">Reader</option>
                            </select>
                            @error('role')
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
