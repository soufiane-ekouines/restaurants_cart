@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        create user
                    </div>
                    <div class="card-header pb-0">
                        <form role="form text-left" method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name" aria-label="Name" aria-describedby="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="Phone" name="Phone"
                                        id="Phone" aria-label="Phone" aria-describedby="Phone"
                                        value="{{ old('Phone') }}">
                                    @error('Phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="Adresse" name="Adresse"
                                        id="Adresse" aria-label="Adresse" aria-describedby="Adresse"
                                        value="{{ old('Adresse') }}">
                                    @error('Adresse')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="desc" name="desc"
                                        id="desc" aria-label="desc" aria-describedby="desc"
                                        value="{{ old('desc') }}">
                                    @error('desc')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                @if (Auth()->user()->role->role->designation=='Developer')
                                <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1" name="role_id">
                                        @foreach ($roles as $role)
                                          <option value="{{ $role->id }}">{{ $role->designation }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endif
                                <input type="text" class="form-control" placeholder="user_id" name="user_id"
                                    id="user_id" aria-label="user_id" aria-describedby="user_id"
                                     value="{{ Auth()->user()->id }}" hidden>

                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control" placeholder="name@example.com" name="email"
                                        id="email" aria-label="Email" aria-describedby="email-addon"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        id="password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault"
                                    checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and
                                        Conditions</a>
                                </label>
                                @error('agreement')
                                    <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try
                                        register again.</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary w-100 my-4 mb-2">Create account</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
