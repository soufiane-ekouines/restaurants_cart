@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        update card
                    </div>
                    <div class="card-header pb-0">
                        <form role="form text-left" method="POST" action="{{ route('card.update',$cart->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="designation" name="designation"
                                        id="designation" aria-label="designation" aria-describedby="designation"
                                       value="{{ $cart->designation }}">
                                    @error('designation')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="tanks" name="tanks"
                                        id="tanks" aria-label="tanks" aria-describedby="tanks"
                                         value="{{ $cart->tanks }}" min="0">
                                    @error('tanks')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="name_wifi" name="name_wifi"
                                        id="name_wifi" aria-label="name_wifi" aria-describedby="name_wifi"
                                         value="{{ $cart->name_wifi }}">
                                    @error('name_wifi')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="password_wifi" name="password_wifi"
                                        id="password_wifi" aria-label="password_wifi" aria-describedby="password_wifi"
                                         value="{{ $cart->password_wifi }}">
                                    @error('password_wifi')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <input type="text" name="user_id" value="{{ Auth()->user()->id }}" hidden>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary w-100 my-4 mb-2">update card</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
