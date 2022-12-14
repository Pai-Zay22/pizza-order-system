@extends('user.layout.master')
@section('title', 'User Home Page')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Category Start -->
                <h5 class="section-title  text-uppercase mb-3"><span class="bg-secondary  ">Filter by Category</span> =
                    {{ count($category) }}</h5>

                <div class="bg-light p-4 mb-30">
                    <div class=" d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('user#homePage') }}"><label class=" text-dark">All</label></a>
                    </div>
                    @foreach ($category as $c)
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#filter', $c->id) }}}"><label
                                    class=" text-dark">{{ $c->name }}</label></a>
                        </div>
                    @endforeach

                </div>
                {{-- Category End --}}
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartListPage') }}">
                                    <button type="button" class="btn btn-primary position-relative mr-3">
                                        <i class="fa-solid fa-cart-shopping p-2"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge text-white rounded bg-info ">
                                            <span class=" p-1">{{ count($totalOrder) }}</span>
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#orderHistory') }}">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-clock-rotate-left p-2"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge text-white rounded bg-info ">
                                            <span class=" p-1">{{count($orderHistory)}}</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <select class=" form-control" id="sorting">
                                    <option value="">Choose one option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="dsc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="listPage" class="row">
                        @if (count($product) != 0)
                            @foreach ($product as $p)
                                <div class=" mx-3">
                                    <input type="hidden" name="" id="userId" value={{Auth::user()->id}}>

                                    <input type="hidden" name="" id="quantity" value="{{2}}">
                                    <div class="product-item bg-light mb-4 " style=" width:300px;">
                                        <div class="product-img position-relative overflow-hidden" style="">
                                            <img class=" img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                                alt="" style="height:200px">
                                            <div class="product-action">
                                                <a href="{{route('user#pizzaDetailPage',$p->id)}}"
                                                    class="btn btn-outline-dark btn-square"><i
                                                        class="fa-solid fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">

                                            <h4 class=" text-info">{{ $p->name }} </h4>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        @else
                            <p class=" text-dark text-center mt-5">There is no pizza!</p>
                        @endif

                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptCode')
    <script>
        $(document).ready(function() {
            $('.fa-shopping-cart').click(function(){
                console.log('click');
            })
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/ajax/addToCart',
                data: status,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = "http://127.0.0.1:8000/user/homePage";
                    }
                }

            });

            $('#sorting').change(function() {
                let sortingValue = $('#sorting').val();
                if (sortingValue == 'asc') {
                    $.ajax({
                        type: 'get',
                        data: {
                            'status': 'asc'
                        },
                        url: 'http://127.0.0.1:8000/ajax/product/list',
                        dataType: 'json',
                        success: function(response) {
                            let data = '';
                            for (let i = 0; i < response.length; i++) {
                                data += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img src="{{ asset('storage/${response[i].image}') }}" alt=""
                                            style=" width:330px;height:200px;">

                                    </div>
                                    <div class="text-center py-4">
                                        <h4 class=" text-info">${response[i].name} </h4>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[i].price} kyats</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>`;

                            };
                            $('#listPage').html(data);
                        }
                    });
                } else if (sortingValue == 'dsc') {
                    $.ajax({
                        type: 'get',
                        data: {
                            'status': 'dsc'
                        },
                        url: 'http://127.0.0.1:8000/ajax/product/list',
                        dataType: 'json',
                        success: function(response) {
                            let data = '';
                            for (let i = 0; i < response.length; i++) {
                                data += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img src="{{ asset('storage/${response[i].image}') }}" alt=""
                                                style=" width:330px;height:200px;">
                                        </div>
                                        <div class="text-center py-4">
                                            <h4 class=" text-info">${response[i].name} </h4>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[i].price} kyats</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>`;
                            };
                            $('#listPage').html(data);
                        }
                    });


                };
            });
        });
    </script>

@endsection
