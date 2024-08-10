<x-layout>
    <x-slot:title>Permissions</x-slot:title>
    <x-notiffication/>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Request Permissions</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Reader</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Book</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Request Date</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Actions</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permit)
                        <tr>
                          <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
                          <td class="border-bottom-0">
                              <h6 class="fw-semibold mb-1">{{ $permit->user->email }}</h6>
                              <span class="fw-normal"></span>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $permit->book->title }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                              <span class="badge bg-primary rounded-3 fw-semibold">{{ $permit->status }}</span>
                            </div>
                          </td>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0 fs-4">{{$permit->created_at->format('Y-m-d') }}</h6>
                          </td>
                          <td class="border-bottom-0">
                            <form action="{{ route('permissions_updateStatus', ['id' => $permit->id, 'action' => 'accept']) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <button class="btn btn-success" type="submit">Accept</button>
                          </form>
                            <form action="{{ route('permissions_updateStatus', ['id' => $permit->id, 'action' => 'decline']) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <button class="btn btn-danger" type="submit">Decline</button>
                            </form>
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
