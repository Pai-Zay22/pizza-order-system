@extends('admin.layouts.master')
@section('title', 'Admin Account Info Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">

            {{-- account successfully updated message
            <div class=" col-6 offset-3">
                @if (session('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show  p-3" role="alert">
                        <span class=" text-bold">{{ session('updateSuccess') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div> --}}

            <div class="col-8 offset-2">
                <div class="card">
                    <div class=" ml-3 mt-3">
                        <i class="fa-solid fa-arrow-left" onclick="history."></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Details</h3>
                        </div>
                        <hr>
                        <div class="row  justify-content-center ">
                            <div class="col ml-3">
                              <img src="{{asset('storage/'.$pizza->image)}}" alt="" style=" border-radius:10px;">
                            </div>
                            <div class="col mr-5">
                                <div class=" btn btn-success text-white">Name -> {{$pizza->name}}</div>
                                <div class=" mt-3 d-flex">
                                    <div class=" btn btn-dark text-white mr-2"><i class="fa-solid fa-money-bill-1"></i> {{$pizza->price}} Mmk</div>
                                    <div class=" btn btn-dark text-white">Category -> {{$pizza->category_id}} </div>
                                </div>
                                <div class=" mt-3 d-flex">
                                    <div class=" btn btn-dark text-white mr-2"><i class="fa-solid fa-eye"></i> {{$pizza->view_count}}</div>
                                    <div class=" btn btn-dark text-white"><i class="fa-solid fa-clock"></i> {{$pizza->waiting_time}} mins </div>
                                </div>
                                <h5 class=" mt-3"><ul>Description</ul></h5>
                                <div class="mt-2">{{$pizza->description}}</div>
                            </div>
                        </div>
                        <div class=" text-center mt-5">
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
    </div>
@endsection
