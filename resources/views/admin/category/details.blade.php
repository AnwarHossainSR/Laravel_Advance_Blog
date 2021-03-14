@extends('admin.master')

@section('title')
    Admin || Category
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Category Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.category.all') }}">Category list</a></li>
                    <li class="breadcrumb-item active">Details</li>
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
                            <h3 class="card-title">Details</h3>
                            <a href="{{ route('admin.category.all') }}" class="btn btn-primary">Go Back to Category List</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                                <table class="table table-hover">
                                    <tr>
                                        <td style="font-size: 22px;font-weight:bold">Category Name</td>
                                        <td style="font-size: 22px">{{ $categories->name }}</td>
                                    </tr>
                                    <tr style="height:100px;">
                                        <td style="font-size: 22px;font-weight:bold">Slug</td>
                                        <td style="font-size: 22px">{{ $categories->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 22px;font-weight:bold">Image</td>
                                        <td><img src="{{ asset('/source/back/category/') }}/{{ $categories->image }}" alt="post image" width="200px" height="150px"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

