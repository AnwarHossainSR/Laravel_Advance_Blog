@extends('admin.master')

@section('title')
    Admin || Post
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pending Post Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.pending') }}">Pending Post list</a></li>
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
                            <a href="{{ route('admin.posts.pending') }}" class="btn btn-primary">Go Back to pending Post List</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                                <table class="table table-hover">
                                    <tr>
                                        <td style="font-size: 22px;font-weight:bold">Title</td>
                                        <td style="font-size: 22px">{{ $posts->title }}</td>
                                    </tr>
                                    <tr style="height:100px;">
                                        <td style="font-size: 22px;font-weight:bold">Slug</td>
                                        <td style="font-size: 22px">{{ $posts->slug }}</td>
                                    </tr>
                                    <tr style="height:100px;">
                                        <td style="font-size: 22px;font-weight:bold">Excerpt</td>
                                        <td style="font-size: 22px">{{ $posts->excerpt }}</td>
                                    </tr>
                                    <tr style="height:100px;">
                                        <td style="font-size: 22px;font-weight:bold">Content</td>
                                        <td style="font-size: 22px">{!! $posts->content !!}</td>
                                    </tr>
                                    <tr style="height:100px;">
                                        <td style="font-size: 22px;font-weight:bold">Category</td>
                                        <td style="font-size: 22px">{{ $category->name }}</td>
                                    </tr>
                                    <tr style="height:100px;">
                                        <td style="font-size: 22px;font-weight:bold">Tags</td>
                                        <td>
                                        @foreach($posts->tags as $tag)
                                            <span class="badge badge-primary" style="font-size:22px; ">{{ $tag->name }} </span>
                                        @endforeach
                                    </td>
                                    </tr>
                                    <tr style="height:100px;">
                                        <td style="font-size: 22px;font-weight:bold">Author</td>
                                        <td style="font-size: 22px">{{ $user->name }}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-size: 22px;font-weight:bold">Image</td>
                                        <td><img src="{{ asset('/upload') }}/{{ $posts->postImage }}" alt="post image" width="200px" height="250px"></td>
                                    </tr>
                                    <tr>
                                        <td ></td>
                                        <td >
                                            <button type="button" class="btn btn-primary" style="width: 100px;"><a href="{{ route('admin.posts.approve',$posts->id) }}" style="color:white;">Approve</a></button>
                                            <form action="{{ route('admin.posts.deny',$posts->id) }}" class="mr-1" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger" style="width: 100px;">Deny</button>
                                            </form>
                                        </td>
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

