@extends('admin.master')

@section('title')
    Admin || Posts
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Favourite Posts List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Favourite Posts list</li>
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
                            <h3 class="card-title">Favourite Posts List</h3>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">id</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Excerpt</th>
                                    <th>Tags</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th style="height:100px;width:100px">Image</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count())
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->slug }}</td>
                                        <td>{{ $post->excerpt }}</td>
                                        <td>
                                            @foreach($post->tags as $tag)
                                                <span class="badge badge-primary">{{ $tag->name }} </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($post->categories as $category)
                                                <span class="badge badge-primary">{{ $category->name }} </span>
                                            @endforeach
                                        </td>
                                        <td>{{ $post->user_id }}</td>
                                        <td>
                                            {{ $post->status }}
                                        </td>
                                        <td><img src="{{ asset('source/back/post') }}/{{ $post->postImage }}" class="rounded-circle" alt="post image" width="120px" height="120px"></td>
                                        {{-- <td><img src="{{ asset('/upload') }}/{{ $category->image }}" class="rounded-circle" alt="post image" width="120px" height="120px"></td> --}}
                                        <td class="d-flex">
                                            <form action="{{ route('admin.posts.favourite.remove',$post->id) }}" class="mr-1" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                                            </form>
                                            <a href="{{ route('user.single-blog',$post->id) }}" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-center">No posts found.</h5>
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


