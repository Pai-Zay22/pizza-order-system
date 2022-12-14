@extends('admin.layouts.master')
@section('title', 'Product List Page')

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
                                <h2 class="title-1 text-black text-xl-center">Product List Page</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#pizzaCreatePage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                       {{-- show delete message --}}
                       @if (session('pizzaDelete'))
                       <div class="alert alert-warning alert-dismissible fade show col-4 offset-8 align-items-center" role="alert">
                           <span class=" text-black">{{ session('pizzaDelete') }}</span>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                       </div>
                   @endif

                    {{-- Search bar total and serach key section  --}}
                    <div class=" my-3 d-flex  justify-content-between align-items-center">
                        <div>
                            <span class=" text-black text-xl-center">Total Product = {{ $pizzas->total() }}</span>
                        </div>
                        <div>
                            <span class=" text-black text-xl-center">Search Key = {{ request('key') }}</span>
                        </div>
                        <div>
                            <form action="{{route('product#pizzaListPage')}}" method="GET">
                                @csrf
                                <div class=" input-group-text">
                                    <input type="text" name="key" id="" value="{{ request('key') }}"
                                        class=" form-control" placeholder="Search Product...">
                                    <button class=" btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow">
                                            <td><img src="{{ asset('storage/' . $p->image) }}" alt=""
                                                    class=" img-thumbnail"style=" width:130px;height:120px;"></td>
                                            <td class="desc text-bold text-5xl">{{ $p->name }}</td>
                                            <td>{{ $p->price }} Mmk</td>
                                            <td> {{ $p->category_name }}</td>
                                            <td> <i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <div class=" mr-3">
                                                        <a href="{{route('product#pizzaUpdatePage',$p->id)}}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class=" mr-3">
                                                        <a href="{{route('product#pizzaInfoPage',$p->id)}}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="View">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <form action="{{route('product#pizzaDelete',$p->id)}}" method="POST">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="item show-alert-delete-box" data-toggle="tooltip" data-placement="top"
                                                            title="Delete" type="submit">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class=" text-dark text-center mt-5">There is no oroduct here!</h3>
                    @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
            <div class=" mt-3 mr-4">
                {{ $pizzas->links() }}
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Are you sure you want to delete this product list?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
