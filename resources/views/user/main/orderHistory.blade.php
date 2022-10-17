@extends('user.layout.master')
@section('title', 'Order History')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height:500px">
          <div class=" ml-5 my-3">
                <a href="{{route('user#homePage')}}" class=" text-dark"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0 dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle ">
                        @foreach ($order as $o)
                           <tr>
                                <td class=" align-middle">{{$o->created_at->format('d/m/Y')}}</td>
                                <td class=" align-middle">{{$o->order_code}}</td>
                                <td class=" align-middle">{{$o->total_price}} kyats</td>
                                <td class=" align-middle">
                                    @if ($o->status == 0)
                                        <span class=" text-warning"><i class="fa-solid fa-clock mr-2"></i>Pending...</span>
                                    @elseif ($o->status == 1)
                                        <span class=" text-success"><i class="fa-solid fa-clock mr-2"></i>Success</span>
                                    @else
                                        <span class=" text-danger"><i class="fa-solid fa-circle-xmark mr-2"></i>Reject</span>
                                    @endif
                                </td>
                           </tr>

                        @endforeach

                    </tbody>
                </table>
              <div class=" mt-2">
                {{$order->links()}}
              </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection


