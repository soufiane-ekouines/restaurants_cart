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
                        <h5 class="mb-0">All Product</h5>
                    </div>
                    <a href="{{ route('product.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                        type="button">+&nbsp; New Product</a>
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
                    @forelse ($products  as $value)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            {{-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> --}}
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $value->designation }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $value->cat->designation }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $value->prix }} DH</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        @if ($value->qte!=0)
                        <span class="badge badge-sm bg-gradient-success">in stock</span>
                        @else
                        <span class="badge badge-sm bg-gradient-danger">out stock</span>
                        @endif
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $value->qte }}</span>
                      </td>
                      @if (Auth()->user()->role->role->designation == 'Developer')
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $value->user->name }}</span>
                      </td>
                      @endif
                      <td style="display: flex;justify-content: space-around;padding: 14px" class="align-middle">
                        <a href="{{ route('product-edit', $value->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                        </a>
                        <form action="{{ route('product.destroy', $value->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button style="border: none;padding: 0" type="submit" class="btn btn-outline-danger" data-toggle="tooltip" data-original-title="Edit user">
                                    x
                            </button>
                        </form>

                      </td>
                    </tr>
                    @empty
                    <p>No content Add Product</p>
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
