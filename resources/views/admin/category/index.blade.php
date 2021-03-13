@extends('admin.master')

@section('title')
    Admin || Category
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Category List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Category list</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Category List</h3>
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create Category</a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status </th>
                                    <th style="height:100px;width:100px">Image</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($categories->count())
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            {{ $category->status }}
                                        </td>
                                        <td><img src="{{ asset('/source/back/category/') }}/{{ $category->image }}" class="rounded-circle" alt="post image" width="120px" height="120px"></td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.category.edit',[$category->id]) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a>
                                            <form action="{{ route('admin.category.delete',[$category->id]) }}" class="mr-1" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                                            </form>
                                            <a href="{{ route('admin.category.details',[$category->id]) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-center">No categories found.</h5>
                                        </td>
                                    </tr>

                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{--  <div class="card-footer d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

