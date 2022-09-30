@extends('admin.layouts.master')
@section('title', 'Admin Account Info Page')
@section('content')
    <div class="main-content">

        <div class="section__content section__content--p30">

            <div class="col-8 offset-2">
                <div class="card">
                    <div class=" ml-3 mt-3">
                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Details</h3>
                        </div>
                        <hr>
                        <div class="row  justify-content-center ">
                            <div class="col ml-3">
                              <img src="{{asset('storage/'.$pizza->image)}}" alt="" style=" border-radius:10px;" class=" img-thumbnail">
                            </div>
                            <div class="col mr-5">
                                <div class=" btn btn-success text-white">Name -> {{$pizza->name}}</div>
                                <div class=" mt-3 d-flex">
                                    <div class=" btn btn-dark text-white mr-2"><i class="fa-solid fa-money-bill-1"></i> {{$pizza->price}} Mmk</div>
                                    <div class=" btn btn-dark text-white">Category -> {{$pizza->category_name}} </div>
                                </div>
                                <div class=" mt-3 d-flex">
                                    <div class=" btn btn-dark text-white mr-2"><i class="fa-solid fa-eye"></i> {{$pizza->view_count}}</div>
                                    <div class=" btn btn-dark text-white mr-2"><i class="fa-solid fa-clock"></i> {{$pizza->waiting_time}} mins </div>
                                    <div class=" btn btn-dark text-white "><i class="fa-solid fa-calendar"></i>  {{$pizza->created_at->format('j / F / y')}}</div>
                                </div>
                                <div>
                                    <h5 class="mt-3 text-bold">Description</h5>
                                    <div class=" mt-2" style = "line-height:20px;">{{$pizza->description}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
