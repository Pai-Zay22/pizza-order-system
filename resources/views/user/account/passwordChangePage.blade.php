@extends('user.layout.master')
@section('title', ' User Change Password Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class=" ml-3 mt-3">
                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change New Password</h3>
                        </div>

                        {{-- old password didn't match message --}}
                        @if (session('notMatch'))
                            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                <span class=" text-bold ">{{ session('notMatch') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <hr>

                        <form action="{{ route('user#pwChange') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password"
                                    class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Enter Old Password">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password"
                                    class="form-control @error('newPassword') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Enter New Password">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password"
                                    class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Enter Confirm Password">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key"></i>
                                    <span id="payment-button-amount">Change Password</span>
                                    <span id="payment-button-sending" style="display:none;">Sending???</span>
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
