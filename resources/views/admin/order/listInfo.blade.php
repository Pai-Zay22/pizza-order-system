@extends('admin.layouts.master')
@section('title', 'Order List Info Page')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class=" ml-3 mb-3">
                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
            </div>
            <div class="card text-center ms-5 " style="width: 20rem;">
                <div class="card-body">
                  <h5 class="card-title">Order Info</h5>
                  <p class="card-text text-warning"> <i class="fa-solid fa-triangle-exclamation"></i> This includes deli fee!</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item mt-2"> Customer Name = <span class=" text-primary"> {{$orderList[0]->user_name}}</span></li>
                  <li class="list-group-item mt-2">Order Code = <span class=" text-primary">{{$orderList[0]->order_code}}</span> </li>
                  <li class="list-group-item mt-2">Order Date = <span class=" text-primary">{{$orderList[0]->created_at->format('F | j | Y')}}</span> <li>
                </ul>
              </div>
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>

                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="listPage">
                                @foreach ($orderList as $o )
                                    <tr class="tr-shadow">
                                        <td>
                                            <img src="{{asset('storage/' . $o->product_image)}}" class=" img-thumbnail" style="width:100px" alt="">
                                        </td>
                                        <td>{{$o->product_name}}</td>
                                        <td>{{$o->quantity}}</td>
                                        <td>{{$o->total_price}} kyats</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>

        </div>
    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection


