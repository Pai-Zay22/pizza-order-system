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
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Role</th>
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
                                        <input type="hidden" name="" id="adminId" value="{{$a->id}}">
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }} </td>
                                        <td>{{ $a->address }} </td>
                                        <td>{{ $a->gender }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id != $a->id)
                                                   <select name=""  class="form-select roleChange" aria-label="Filter select">
                                                        <option value="admin" selected>Admin</option>
                                                        <option value="user">User</option>
                                                   </select>
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
@endsection
@section('scriptCode')
    <script>
        $(document).ready(function(){
            $('.roleChange').change(function(){
                let currentStatus = $(this).val();
                let parentNode = $(this).parents('tr');
                let adminId = parentNode.find('#adminId').val();
                let give = {
                    'status' : currentStatus,
                    'adminId' : adminId
                }
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/admin/ajax/role/change',
                    data : give,
                    dataType : 'json',
                });
                 location.reload();

            });
        })
    </script>
@endsection
