@extends('layouts.user_type.auth')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">All Message</h5>
                    </div>
                    <a href="{{ route('Message.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                        type="button">+&nbsp; New Message</a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Designation</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Prix</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QTE</th>
                      @if (Auth()->user()->role->role->designation == 'Developer')
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">admin</th>
                      @endif
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($emplyee  as $item)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            {{-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> --}}
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $item->name }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $item->Lastmessage }} DH</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $Message->message->count() }}</span>
                      </td>
                      <td style="display: flex;justify-content: space-around;padding: 14px" class="align-middle">
                        <a href="{{ route('Message-edit', $Message->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                        </a>
                        <form action="{{ route('Message.destroy', $Message->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button style="border: none;padding: 0" type="submit" class="btn btn-outline-danger" data-toggle="tooltip" data-original-title="Edit user">
                                    x
                            </button>
                        </form>

                      </td>
                    </tr>
                    @empty
                    <p>No content Add Message</p>
                    @endforelse

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  @endsection
