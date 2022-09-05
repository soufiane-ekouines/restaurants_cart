@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        update product
                    </div>
                    <div class="card-header pb-0">
                        <form role="form text-left" method="POST" action="{{ route('product.update',$product->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="designation" name="designation"
                                        id="designation" aria-label="designation" aria-describedby="designation"
                                       value="{{ $product->designation }}">
                                    @error('designation')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="number" class="form-control" placeholder="prix" name="prix"
                                        id="prix" aria-label="prix" aria-describedby="prix"
                                         value="{{ $product->prix }}" min="0">
                                    @error('prix')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" placeholder="qte" name="qte"
                                        id="qte" aria-label="qte" aria-describedby="qte"
                                         value="{{ $product->qte }}">
                                    @error('qte')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <select class="form-control" id="exampleFormControlSelect1" name="cat_id">
                                      <option value="{{ $product->cat->id }}" hidden>{{ $product->cat->designation }}</option>
                                    @foreach ($cat as $value)
                                      <option value="{{ $value->id }}">{{ $value->designation }}</option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            </div>

                            <input type="text" name="user_id" value="{{ Auth()->user()->id }}" hidden>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary w-100 my-4 mb-2">update product</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
