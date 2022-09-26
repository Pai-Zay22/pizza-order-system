@extends('admin.layouts.master')
@section('title','Pizza Create Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#pizzaListPage')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#pizzaCreate')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-2 text-primary">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza name...">
                                @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-2 text-primary">Description</label>
                                <textarea name="pizzaDescription" id="" value="{{old('pizzaDescription')}}" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter pizza description...">{{old('pizzaDescription')}}</textarea>
                                @error('pizzaDescription')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-2 text-primary">Pizza Image</label>
                                <input type="file" name="pizzaImage" id=""  class="form-control @error('pizzaImage') is-invalid @enderror">
                                @error('pizzaImage')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-2 text-primary">Category</label>
                                <select name="pizzaCategory" id="" value="{{old('pizzaCategory')}}" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                    <option value="">Choose your category</option>
                                    @foreach ($categories as $c )
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>


                            <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-2 text-primary">Price</label>
                                <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice')}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza price..">
                                @error('pizzaPrice')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="cc-payment" class="control-label mb-2 text-primary">Waiting Time</label>
                                <input id="cc-pament" name="waitingTime" type="number" value="{{old('waitingTime')}}" class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter waiting time">
                                @error('waitingTime')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
