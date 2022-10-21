@extends('admin.layouts.master')
@section('title', 'User List Page')

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
                                <h2 class="title-1 text-black">User List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="listPage">
                                @foreach ($user as $u)
                                    <tr class="tr-shadow">
                                        <td>
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <div class="image" style="border-radius: 50%;width:100px">
                                                        <img src="{{ asset('image/default_user.jpg') }}" alt="John Doe" />
                                                    </div>
                                                @else
                                                    <div class="image" style="border-radius: 50%;width:100px">
                                                        <img src="{{ asset('image/default_female.jpg') }}" alt="John Doe" />
                                                    </div>
                                                @endif
                                             @else
                                                <div class="image">
                                                    <img src="{{ asset('storage/'.$u()->image) }}" style="width:100px" alt="John Doe" />
                                                </div>
                                             @endif
                                        </td>
                                        <input type="hidden" name="" id="userId" value="{{$u->id}}">
                                        <td class=" text-primary">{{$u->name}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>{{$u->address}}</td>
                                        <td>{{$u->phone}}</td>
                                        <td>{{$u->gender}}</td>
                                        <td>
                                            <select name=""  class="form-select roleChange" aria-label="Filter select">
                                                <option value="user" selected>User</option>
                                                <option value="admin">Admin</option>
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
        $(document).ready(function(){
           $('.roleChange').change(function(){
                let currentStatus = $(this).val();
                let parent = $(this).parents('tr');
                let userId = parent.find('#userId').val();
                let give = {
                    'status' : currentStatus,
                    'userId' : userId
                }
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/user/role/change',
                    data : give,
                    dataType : 'json',
                });
                 location.reload();
           })
        })
    </script>
@endsection
