@extends('admin.layouts.master')
@section('title', 'Admin List Page')

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
                                <h2 class="title-1 text-black text-xl-center">Admin List Page</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#pizzaCreatePage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    {{-- Search bar total and serach key section  --}}
                    <div class=" my-3 d-flex  justify-content-between align-items-center">
                        <div>
                            <span class=" text-black text-xl-center">Total Admin = </span>
                        </div>
                        <div>
                            <span class=" text-black text-xl-center">Search Key = {{ request('key') }}</span>
                        </div>
                        <div>
                            <form action="{{ route('admin#listPage') }}" method="GET">
                                @csrf
                                <div class=" input-group-text">
                                    <input type="text" name="key" id="" value="{{ request('key') }}"
                                        class=" form-control" placeholder="Search Admin...">
                                    <button class=" btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Adddress</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        @if ($a->image == null)
                                            @if ($a->gender == 'male')
                                                <td>
                                                    <img src="{{ asset('image/default_user.jpg') }}" alt="John Doe"
                                                        style=" width:100px;height:100px" />
                                                </td>
                                            @else
                                                <td>
                                                    <img src="{{ asset('image/default_female.jpg') }}" alt="John Doe"
                                                        style=" width:100px;height:100px" />
                                                </td>
                                            @endif
                                        @else
                                            <td>
                                                <img src="{{ asset('storage/' . $a->image) }}" alt="{{ $a->name }}"
                                                    style=" width:100px;height:100px" />
                                            </td>
                                        @endif

                                        <td class="desc text-bold text-5xl">{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }} </td>
                                        <td>{{ $a->address }} </td>
                                        <td>{{ $a->gender }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id != $a->id)
                                                    <form action="{{ route('admin#listDelete', $a->id) }}" method="POST">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="item show-alert-delete-box" data-toggle="tooltip"
                                                            data-placement="top" title="remove" type="submit">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>

                                                    <div class=" ml-2">
                                                        <a href="{{ route('admin#roleChangePage', $a->id) }}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="role change" type="submit">
                                                                <i class="fa-solid fa-user-pen text-center"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
            <div class=" mt-3 mr-4">
                {{ $admin->links() }}
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Are you sure you want to remove this admin?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes!"],
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
