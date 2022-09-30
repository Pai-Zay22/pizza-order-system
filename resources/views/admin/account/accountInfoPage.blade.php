@extends('admin.layouts.master')
@section('title', 'Admin Account Info Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">

            {{-- account successfully updated message --}}
            <div class=" col-6 offset-3">
                @if (session('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show  p-3" role="alert">
                        <span class=" text-bold">{{ session('updateSuccess') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row  justify-content-center align-items-center">
                            <div class="col ml-3">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
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
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="John Doe" />
                                    </div>
                                @endif
                            </div>
                            <div class="col mr-5">
                                <div class=" mb-3"><i class=" mr-2 fa-solid fa-user "></i><span
                                        class=" text-2xl text-bold">{{ Auth::user()->name }}</span></div>
                                <div class=" mb-3"> <i class=" mr-2 fa-solid fa-envelope"></i><span
                                        class=" text-2xl text-bold">{{ Auth::user()->email }}</span></div>
                                <div class=" mb-3"><i class=" mr-2 fa-solid fa-phone"></i><span
                                        class=" text-2xl text-bold">{{ Auth::user()->phone }}</span></div>
                                <div class=" mb-3"><i class=" mr-2 fa-solid fa-location-dot"></i><span
                                        class=" text-2xl text-bold">{{ Auth::user()->address }}</span></div>
                                <div class=" mb-3"><i class=" mr-2 fa-solid fa-calendar-days"></i><span
                                        class=" text-2xl text-bold">{{ Auth::user()->created_at->format('j/F/Y') }}</span>
                                </div>
                                <div class=" mb-3"><i class=" mr-2 fa-solid fa-venus"></i><span
                                        class=" text-2xl text-bold">{{ Auth::user()->gender }}</span></div>
                            </div>
                        </div>
                        <div class=" text-center">
                            <a href="{{ route('admin#accountEditPage') }}">
                                <button class=" btn btn-dark text-white text-center"><i
                                        class=" mr-2 fa-solid fa-pen"></i>Edit Info</button>

                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
