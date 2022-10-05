@extends('user.layout.master')
@section('title', 'User Account Update Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class=" ml-3 mt-3">
                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Update Page</h3>
                        </div>
                        <hr>
                    </div>
                    <form action="{{ route('user#accountUpdate', Auth::user()->id) }})}}", method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex">
                            <div class="col-5 offset-1">
                                @if (Auth::user()->image == null)
                                    <div class="image" style="border-radius: 50%;">
                                        <img src="{{ asset('image/default_user.jpg') }}" alt="John Doe" />
                                    </div>
                                @else
                                    <div class="image">
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt="{{ Auth::user()->name }}" style=" width:350px;border-radius:10px;" />
                                    </div>
                                @endif
                                <div class=" my-2 col-10">
                                    <input type="file" name="image" id=""
                                        class=" form-control @error('image') is-invalid
                                    @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text"
                                            class="form-control @error('name') is-invalid

                                        @enderror"
                                            value="{{ old('name', Auth::user()->name) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text"
                                            class="form-control @error('email') is-invalid

                                        @enderror"
                                            value="{{ old('email', Auth::user()->email) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number"
                                            class="form-control @error('phone') is-invalid

                                        @enderror"
                                            value="{{ old('phone', Auth::user()->phone) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin phone ">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <input id="cc-pament" name="address" type="text"
                                            class="form-control @error('address') is-invalid

                                        @enderror "
                                            value="{{ old('address', Auth::user()->address) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin address ">
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" id=""
                                            class=" form-control @error('gender') is-invalid

                                        @enderror">
                                            <option value="">Choose an option</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" type="text"
                                            class="form-control @error('role') is-invalid

                                        @enderror"
                                            value="{{ old('role', Auth::user()->role) }}" aria-required="true"
                                            aria-invalid="false" placeholder="Enter admin address" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class=" my-4 col-6 offset-5">
                                <button class=" btn btn-dark text-white" type="submit"> <i
                                        class="fa-regular fa-circle-check mr-2"></i> Update Info</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
