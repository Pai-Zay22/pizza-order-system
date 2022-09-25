@extends('admin.layouts.master')
@section('title', 'Admin Account Info Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col ml-3">
                                @if (Auth::user()->image == null)
                                    <div class="image" style="border-radius: 50%;">
                                        <img src="{{ asset('image/default_user.jpg') }}" alt="John Doe" />
                                    </div>
                                @else
                                    <div class="image">
                                        <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                    </div>
                                @endif
                            </div>
                            <div class="col mr-5">
                                <div class=" mb-2"><i class=" mr-2 fa-solid fa-user "></i><span
                                        class="mb-2  text-2xl text-bold">{{ Auth::user()->name }}</span></div>
                                <div class=" mb-2"> <i class=" mr-2 fa-solid fa-envelope"></i><span
                                        class="mb-2  text-2xl text-bold">{{ Auth::user()->email }}</span></div>
                                <div class=" mb-2"><i class=" mr-2 fa-solid fa-phone"></i><span
                                        class="mb-2  text-2xl text-bold">{{ Auth::user()->phone }}</span></div>
                                <div class=" mb-2"><i class=" mr-2 fa-solid fa-location-dot"></i><span
                                        class="mb-2  text-2xl text-bold">{{ Auth::user()->address }}</span></div>
                            </div>
                        </div>
                        <div class=" text-center">
                            <button class=" btn btn-dark text-white text-center"><i class=" mr-2 fa-solid fa-pen"></i>Edit Info</button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
