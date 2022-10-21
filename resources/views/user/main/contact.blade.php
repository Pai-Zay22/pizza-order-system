@extends('user.layout.master')
@section('title','Contact Page')
@section('content')
    <div class="container">
        <div class="row">

                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Contact Us Anytime!</h3>
                            </div>
                            <hr>
                            <form action="{{route('user#contactSend')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="userName" value="{{old('userName')}}" type="text" class="form-control @error('userName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name">
                                    @error('userName')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror

                                    <label for="cc-payment" class="control-label mb-1 mt-3">Phone</label>
                                    <input id="cc-pament" name="userPhone" value="{{old('userPhone')}}" type="number" class="form-control @error('userPhone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Phone Number">
                                    @error('userPhone')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror

                                    <label for="cc-payment" class="control-label mb-1 mt-3">Email</label>
                                    <input id="cc-pament" name="userEmail" value="{{old('userEmail')}}" type="text" class="form-control @error('userEmail') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email">
                                    @error('userEmail')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    <label for="cc-payment" class="control-label mb-1 mt-3">Message</label>
                                    <textarea name="message" id="" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder=" Enter what you want to tell us...">{{old('message')}}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block mt-5">
                                        <span id="payment-button-amount">Send</span>
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
@endsection
