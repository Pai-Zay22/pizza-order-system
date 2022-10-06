@extends('user.layout.master')
@section('title','Pizza Detail Page')

@section('content')

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class=" ml-5 my-3">
            <a href="{{route('user#homePage')}}" class=" text-dark"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="">
                            <img class="w-100 h-100" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 class=" text-success">{{$pizza->name}}</h3>
                    <input type="hidden" id="productId" name="" value="{{$pizza->id}}">
                    <input type="hidden" id="userId" name="" value="{{Auth::user()->id}}">
                    <div><i class="fa-solid fa-eye mr-2 my-2"></i>{{$pizza->view_count}}</div>
                    <h5 class="font-weight-semi-bold mb-4">{{$pizza->price}} kyats</h5>
                    <p class=" mb-3">{{$pizza->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text"  id ="quantity" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="cartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $list )
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden" style=" height:250px">
                            <img class="img-fluid w-100" src="{{asset('storage/'.$list->image)}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetailPage',$list->id)}}"><i class="fa-solid fa-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate text-success " href="">{{$list->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$list->price}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptCode')
    <script>
        $(document).ready(function(){
            $('#cartBtn').click(function(){
                let quantity = $('#quantity').val();
                let userId = $('#userId').val();
                let productId = $('#productId').val();
                let status = {
                    'userId' : userId,
                    'productId' : productId,
                    'quantity' : quantity,
                };
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/addToCart',
                    data : status,
                    dataType : 'json',
                    success: function(response){
                       if(response.status == 'success'){
                            window.location.href = "http://127.0.0.1:8000/user/homePage";
                       }
                    }

                });
            })

        })
    </script>
@endsection
