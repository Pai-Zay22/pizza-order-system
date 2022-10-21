@extends('admin.layouts.master')
@section('title', 'Message List')

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
                                <h2 class="title-1 text-black">Contact Message</h2>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody id="listPage">
                                @foreach ($message as $m )
                                <tr class="tr-shadow">
                                    <td>{{$m->name}}</td>
                                    <td>{{$m->email}}</td>
                                    <td>{{$m->phone}}</td>
                                    <td>{{$m->message}}</td>
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
