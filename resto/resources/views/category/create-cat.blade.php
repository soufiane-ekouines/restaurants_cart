@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        create category
                    </div>
                    <div class="card-header pb-0">
                        <form role="form text-left" method="POST" action="{{ route('category.store') }}">
                            @csrf
                                <div class="col-md">
                                    <input type="text" class="form-control" placeholder="designation" name="designation"
                                        id="designation" aria-label="designation" aria-describedby="designation"
                                        value="{{ old('designation') }}">
                                    @error('designation')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                          
                                <input type="text" class="form-control" placeholder="user_id" name="user_id"
                                    id="user_id" aria-label="user_id" aria-describedby="user_id"
                                     value="{{ Auth()->user()->id }}" hidden>

                            </div>
                            

                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary w-100 my-4 mb-2">Create category</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
