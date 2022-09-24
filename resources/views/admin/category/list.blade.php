@extends('admin.layouts.master')
@section('title', 'Category List Page')

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
                                <h2 class="title-1 text-primary">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    {{-- show delete message --}}
                    @if (session('categoryDelete'))
                        <div class="alert alert-warning alert-dismissible fade show col-4 offset-8" role="alert">
                            <span class=" text-black">{{ session('categoryDelete') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- show delete message --}}
                    @if (session('categoryUpdate'))
                        <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                            <span class=" text-bold ">{{ session('categoryUpdate') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Search bar total and serach key section  --}}
                    <div class=" my-3 d-flex  justify-content-between align-items-center">
                        <div>
                            <span class=" text-primary">Total Categoty = {{ $categories->total() }}</span>
                        </div>
                        <div>
                            <span class=" text-primary">Search Key = {{ request('key') }}</span>
                        </div>
                        <div>
                            <form action="{{ route('category#list') }}" method="GET">
                                @csrf
                                <div class=" input-group-text">
                                    <input type="text" name="key" id="" value="{{ request('key') }}"
                                        class=" form-control" placeholder="Search Category...">
                                    <button class=" btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created at</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td class="desc">{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('d-m-y H:i:s') }}</td>
                                            <td>

                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                    <i class="zmdi zmdi-mail-send"></i>
                                                </button> --}}
                                                    <div class=" mr-3">
                                                        <a href="{{ route('category#edit', $category->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <a href="{{ route('category#delete', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
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
                        <h3 class=" text-primary text-center mt-5">There is no category!</h3>

                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
            <div class=" mt-3 mr-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>
@endsection
