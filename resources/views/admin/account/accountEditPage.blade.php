@extends('admin.layouts.master')
@section('title', 'Admin Account Edit Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Edit Page</h3>
                        </div>
                        <hr>
                    </div>
                    <form action="">
                        <div class="row d-flex">
                            <div class="col-5 offset-1">
                                @if (Auth::user()->image == null)
                                    <div class="image" style="border-radius: 50%;">
                                        <img src="{{ asset('image/default_user.jpg') }}" alt="John Doe" />
                                    </div>
                                @else
                                    <div class="image">
                                        <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                    </div>
                                @endif
                                <div class=" my-2 col-10">
                                    <input type="file" name="image" id="" class=" form-control">
                                </div>
                            </div>
                            <div class="col-5">
                                @csrf
                                <div class="form-group">
                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control"
                                            value="{{ Auth::user()->name }}" aria-required="true" aria-invalid="false"
                                            placeholder="Enter admin name">
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">email</label>
                                        <input id="cc-pament" name="email" type="text" class="form-control"
                                            value="{{ Auth::user()->email }}" aria-required="true" aria-invalid="false"
                                            placeholder="Enter admin email">
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">phone</label>
                                        <input id="cc-pament" name="phone" type="number" class="form-control"
                                            value="{{ Auth::user()->phone }}" aria-required="true" aria-invalid="false"
                                            placeholder="Enter admin phone ">
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">address</label>
                                        <input id="cc-pament" name="address" type="text" class="form-control"
                                            value="{{ Auth::user()->role }}" aria-required="true" aria-invalid="false"
                                            placeholder="Enter admin address" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class=" my-4 text-center">
                               <button class=" btn btn-dark text-white ">  <i class="fa-regular fa-circle-check mr-2"></i> Update Info</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
