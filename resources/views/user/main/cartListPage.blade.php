@extends('user.layout.master')
@section('title', 'Order List Page')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
          <div class=" ml-5 my-3">
                <a href="{{route('user#homePage')}}" class=" text-dark"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0 dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle ">
                        @foreach ($cartListData as $c)
                            <tr>
                                <input type="hidden" name="" value="{{$c->product_id}}" class="pId">
                                <td class="align-middle ">{{ $c->pizzaName }}</td>

                                <td class="align-middle price">{{ $c->pizzaPrice }} kyats</td>
                                <input type="hidden" name="" class=" uId" value="{{$c->user_id}}">
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus btnMinus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $c->quantity }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus btnPlus" >
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <input type="hidden" name="" value="{{$c->id}}" class="orderId">
                                <td class="align-middle totalPrice">{{$c->pizzaPrice * $c->quantity}} kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 class="tprice">{{$totalPrice}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delievery</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 class=" fprice">{{$totalPrice + 3000}} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 proceedBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 removeBtn">Remove All Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptCode')
    <script>
        $(document).ready(function(){
            $('.btnPlus').click(function(){
               let parentNode = $(this).parents('tr');
               let price = Number(parentNode.find('.price').text().replace('kyats',''));
               let quantity = Number(parentNode.find('#qty').val());
               let total = price * quantity;
               parentNode.find('.totalPrice').html(total +' ' +'kyats');
                summaryTotal();
            });

            $('.btnMinus').click(function(){
                let parentNode = $(this).parents('tr');
                let price = Number(parentNode.find('.price').text().replace('kyats',''));
                let quantity = Number(parentNode.find('#qty').val());
                let total = price * quantity;
                parentNode.find('.totalPrice').html(total + 'kyats');
                summaryTotal();
            })

            $('.btnRemove').click(function(){

                let orderId = $('.orderId').val();
                let productId = $('.pId').val();
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/cartItemRemove',
                    data : {'orderId' : orderId ,'productId' : productId},
                    dataType : 'json',
                });
                let parentNode = $(this).parents('tr');
                parentNode.remove();
                summaryTotal();

            })

            //get summary total
            function summaryTotal(){
                let totalPrice = 0;
                $('.dataTable tbody tr').each(function(index,row){
                    let data = Number($(row).find('.totalPrice').text().replace('kyats',''));
                    totalPrice += data;
                });
                $('.tprice').html(totalPrice +' '+ 'kyats');
                $('.fprice').html(totalPrice+3000 +' ' + 'kyats');
            }

        });
     </script>

     <script>
         //proceed to checkout
        $('.proceedBtn').click(function(){
                let orderList = [];
                let random = Math.floor(Math.random()*1000000);
                $('.dataTable tbody tr').each(function(index,row){
                    orderList.push({
                    'user_id' : $(row).find('.uId').val(),
                    'product_id' : $(row).find('.pId').val(),
                    'quantity' : $(row).find('#qty').val(),
                    'total_price' : $(row).find('.totalPrice').text().replace('kyats','')*1,
                    'order_code' : 'POS' + random,
                    });
                });
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/orderList',
                    data : Object.assign({}, orderList),
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            window.location.href = "http://127.0.0.1:8000/user/homePage";
                        }

                    }
                });
            });

        //remove all order
        $('.removeBtn').click(function(){
           $('.dataTable tbody tr').remove();
           $('.tprice').html('0 kyats');
           $('.fprice').html('3000 kyats');

           $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/cartRemove',
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            window.location.href = "http://127.0.0.1:8000/user/homePage";
                        }

                    }
            });

        })
     </script>
@endsection
