@extends('admin.layouts.master')
@section('title', 'Pizza Edit Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="col-lg-10 offset-1">
                <div class="card">
                   <a href="{{route('product#pizzaListPage')}}" class=" text-decoration-none">
                    <div class=" ml-3 mt-3">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                   </a>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Update Page</h3>
                        </div>
                        <hr>
                    </div>
                    <form action="{{route('product#pizzaUpdate',$pizza->id) }})}}", method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex">
                            <div class="col-5 offset-1">

                                <img src="{{asset('storage/'.$pizza->image)}}" alt="" class=" img-thumbnail">
                                <div class=" my-2 col-10">
                                    <input type="file" name="pizzaImage" id=""
                                        class=" form-control @error('pizzaImage') is-invalid
                                    @enderror">
                                    @error('pizzaImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">

                                    <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text"
                                            class="form-control @error('pizzaName') is-invalid

                                        @enderror"
                                            value="{{ old('pizzaName', $pizza->name) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter Pizza Name">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="">Description</label>
                                        <textarea name="pizzaDescription" id="" cols="30" class = "form-control @error('pizzaDescription') is-invalid

                                        @enderror"rows="5">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" id=""
                                            class=" form-control @error('pizzaCategory') is-invalid

                                        @enderror">
                                            <option value="">Choose the category</option>
                                            @foreach ($category as $c)
                                            <option value="{{$c->id}}" @if ($c->id == $pizza->category_id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" type="number"
                                            class="form-control @error('pizzaPrice') is-invalid

                                        @enderror"
                                            value="{{ old('pizzaPrice', $pizza->price) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter  Pizza Price ">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="waitingTime" type="text"
                                            class="form-control @error('waitingTime') is-invalid

                                        @enderror "
                                            value="{{ old('waitingTime', $pizza->waiting_time) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin waitingTime ">
                                        @error('waitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="role" type="text"
                                            class="form-control"
                                            value="{{ $pizza->view_count }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin address" disabled>
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Created at</label>
                                        <input id="cc-pament" name="role" type="text"
                                            class="form-control"
                                            value="{{ $pizza->created_at->format('j / F / y')}}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin address" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class=" my-4 text-center">
                                <button class=" btn btn-dark text-white" type="submit"> <i
                                        class="fa-regular fa-circle-check mr-2"></i> Update Pizza</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
