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
                        <h5 class="mb-0">All Category</h5>
                    </div>
                    <a href="{{ route('category.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                        type="button">+&nbsp; New Category</a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Product</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($category as $value)
                     <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            {{-- <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify"> --}}
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $value->designation }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $value->Products->sum('prix') }} DH</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                     <?php  $number =(int)(($value->Products->count()/$NmProdict)*100); ?>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">{{ $number }}%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $number }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $number }}%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td style="display: flex;justify-content: space-around" class="align-middle">
                        <a href="{{ route('cat-edit', $value->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                        </a>
                        <form action="{{ route('category.destroy', $value->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button style="border: none;padding: 0" type="submit" class="btn btn-outline-danger" data-toggle="tooltip" data-original-title="Edit user">
                                    x
                            </button>
                        </form>

                      </td>
                    </tr>
                    @empty
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
