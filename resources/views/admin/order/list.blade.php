@extends('admin.layouts.master')
@section('title', 'Order List Page')

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">

                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 text-black">Order List</h2>

                            </div>
                        </div>
                    </div>

                    <div class=" d-flex justify-center align-items-center">
                        <div class=" mr-3">Order Status =</div>
                        <div>
                           <form action="{{route('order#changeMainStatus')}}" method="GET">
                            @csrf
                            <div class=" d-flex">
                                <select name="status"  class="form-select " aria-label="Filter select">
                                    <option value="">All </option>
                                    <option value="0">Pending</option>
                                    <option value="1">Success</option>
                                    <option value="2">Reject</option>
                                </select>
                                <button class=" btn btn-dark text-white ms-1" type="submit">Search</button>
                            </div>
                           </form>
                        </div>
                    </div>

                    {{-- Search bar total and serach key section  --}}
                    <div class=" my-3 d-flex  justify-content-between align-items-center">
                        <div>
                            <span class=" text-black">Total Order = {{ count($order) }} </span>
                        </div>
                        <div>
                            <span class=" text-black">Search Key ={{ request('key') }} </span>
                        </div>
                        <div>
                            <form action="" method="GET">
                                @csrf
                                <div class=" input-group-text">
                                    <input type="text" name="key" id="" value="" class=" form-control"
                                        placeholder="Search Order...">
                                    <button class=" btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="listPage">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" name="" id="orderId" value="{{$o->id}}">
                                        <td>{{ $o->user_id }}</td>
                                        <td >{{ $o->user_name }}</td>
                                        <td>{{ $o->created_at->format('j.F.Y') }}</td>

                                        <td class=" text-primary"><a href="{{route('order#listInfoPage',$o->order_code)}}">
                                        {{$o->order_code}}
                                        </a></td>

                                        <td>{{ $o->total_price }} kyats</td>
                                        <td>
                                            <select name="" class="form-select orderStatus " aria-label="Filter select">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Rejected</option>
                                            </select>
                                        </td>
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

@section('scriptCode')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     let orderStatus = $('#orderStatus').val();
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://127.0.0.1:8000/order/ajaxStatus',
            //         data: {
            //             'status': orderStatus
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             let data = '';
            //             for (let i = 0; i < response.length; i++) {
            //                 let dbDate = new Date(response[i].created_at);
            //                 let months = ['January', 'Febuary', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];
            //                 let finalDate = dbDate.getDate() + '.' + months[dbDate.getMonth()] +
            //                     '.' + dbDate.getFullYear();
            //                 if (response[i].status == 0) {
            //                     statusMessage = `
            //                         <select name="" class="form-select " aria-label="Filter select" id="selection">
            //                                         <option value="0" selected>Pending</option>
            //                                         <option value="1" >Success</option>
            //                                         <option value="2" >Rejected</option>
            //                         </select>
            //                         `
            //                 }else if(response[i].status == 1){
            //                     statusMessage = `
            //                         <select name="" class="form-select " aria-label="Filter select" id="selection">
            //                                         <option value="0" >Pending</option>
            //                                         <option value="1" selected >Success</option>
            //                                         <option value="2" >Rejected</option>
            //                         </select>
            //                         `
            //                 }else if(response[i].status == 2){
            //                     statusMessage = `
            //                         <select name="" class="form-select " aria-label="Filter select"id="selection">
            //                                         <option value="0" >Pending</option>
            //                                         <option value="1" >Success</option>
            //                                         <option value="2" selected >Rejected</option>
            //                         </select>
            //                         `
            //                 }

            //                 data += ` <tr class="tr-shadow">
            //                                 <td>${response[i].user_id}</td>
            //                                 <td>${response[i].user_name}</td>
            //                                 <td>${finalDate}</td>
            //                                 <td>${response[i].order_code}</td>
            //                                 <td>${response[i].total_price} kyats</td>
            //                                 <td>${statusMessage}</td>
            //                             </tr>
            //                      `;

            //             };
            //             $('#listPage').html(data);
            //         }

            //     });
            // });
            $('.orderStatus').change(function(){
                let currentStatus = $(this).val();
                let parentNode = $(this).parents('tr');
                let orderId = parentNode.find('#orderId').val();
                let give = {
                    'status' : currentStatus,
                    'orderId' : orderId
                }
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/order/ajax/change/status',
                    data : give,
                    dataType : 'json',

                 });
            })
        });
    </script>
@endsection
