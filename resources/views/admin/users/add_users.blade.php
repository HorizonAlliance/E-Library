<x-layout>
    <x-slot:title>Add Users</x-slot:title>
    <x-notiffication/>
    <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Forms</h5>
              <div class="card">
                <div class="card-body">
                  <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                      @error('email')
                      <div id="emailHelp" class="form-text text-warning">{{$message}}</div>
                    @enderror                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Username</label>
                      <input type="text" class="form-control" id="exampleInputtext1" name="username" required>
                      @error('username')
                        <div id="emailHelp" class="form-text text-warning">{{$message}}</div>
                      @enderror
                      
                      <label for="exampleInputEmail1" class="form-label">name</label>
                      <input type="text" class="form-control" id="exampleInputtext1" name="name" required>
                      <div id="emailHelp" class="form-text">aslkdhlakshd</div>
                      @error('name')
                        <div id="emailHelp" class="form-text text-warning">{{$message}}</div>
                      @enderror

                      <label for="exampleInputEmail1" class="form-label">address</label>
                      <input type="text" class="form-control" id="exampleInputtext1" name="address" required>
                      @error('address')
                        <div id="emailHelp" class="form-text text-warning">{{$message}}</div>
                      @enderror
                      <label for="exampleInputEmail1" class="form-label">avatar</label>
                      <input type="file" class="form-control" id="exampleInputtext1" name="avatar">
                      @error('avatar')
                        <div id="emailHelp" class="form-text text-warning">{{$message}}</div>
                      @enderror

                      <label for="exampleInputEmail1" class="form-label">role</label>
                      <select name="role" id="" class="form-control">
                        <option>Chose Role</option>
                        <option class="form-control" value="admin">Admin</option>
                        <option class="form-control" value="librarian">Librarian</option>
                        <option class="form-control" value="reader">Reader</option>
                      </select>
                      @error('role')
                        <div id="emailHelp" class="form-text text-warning">{{$message}}</div>
                      @enderror

                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                    {{-- <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
</x-layout>
