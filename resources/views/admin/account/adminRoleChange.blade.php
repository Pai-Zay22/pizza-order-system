@extends('admin.layouts.master')
@section('title', 'Admin Account Edit Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class=" ml-3 mt-3">
                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Role Change Page</h3>
                        </div>
                        <hr>
                    </div>
                    <form action="{{ route('admin#roleChange',$data->id) }})}}", method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex">
                            <div class="col-5 offset-1">
                                @if ($data->image == null)
                                    @if ($data->gender == 'male')
                                        <div class="image" style="border-radius: 50%;">
                                            <img src="{{ asset('image/default_user.jpg') }}" alt="John Doe" />
                                        </div>
                                    @else
                                        <div class="image" style="border-radius: 50%;">
                                            <img src="{{ asset('image/default_female.jpg') }}" alt="John Doe" />
                                        </div>
                                    @endif
                                @else
                                    <div class="image">
                                        <img src="{{ asset('storage/' . $data->image) }}" style="width:300px;border-radius:10px;"alt="John Doe" />
                                    </div>
                                @endif
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text"
                                            class="form-control" value="{{ $data->name }}" aria-required="true" aria-invalid="false" disabled>
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text" class="form-control"
                                            value="{{  $data->email }}" aria-required="true"
                                            aria-invalid="false" disabled>
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number"
                                            class="form-control"
                                            value="{{  $data->phone }}" aria-required="true"
                                            aria-invalid="false" disabled>
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <input id="cc-pament" name="address" type="text"
                                            class="form-control"
                                            value="{{  $data->address }}" aria-required="true"
                                            aria-invalid="false" disabled>
                                    </div>

                                    <div class=" mt-3">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <input id="cc-pament" name="address" type="text"
                                            class="form-control"
                                            value="{{  $data->gender }}" aria-required="true"
                                            aria-invalid="false" disabled>
                                    </div>



                                    <div class=" mt-3">
                                        <label for="">Role</label>
                                        <select name="role" id="" class=" form-control">
                                            <option value="admin" @if ($data->gender == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if ($data->gender == 'user') selected @endif>User</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class=" my-4 text-center">
                                <button class=" btn btn-dark text-white" type="submit"> <i
                                        class="fa-regular fa-circle-check mr-2"></i> Update Role</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
