@extends('superadmin.master')
@section('title')
    Admin || Post
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Post Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{ route('post.index') }}">Post</a></li>
                    <li class="breadcrumb-item active">Manage</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            @include('superadmin.include.alert')

            <div class="card-header">
                <a href="{{ route('post.create') }}" class="card-title btn btn-success float-left">
                    <i class="fas fa-plus-circle nav-icon"></i>
                    Create Post
                  </a>
              <a href="{{-- {{ route('post.create') }} --}}" class="card-title btn btn-danger float-right">
                <i class="fas fa-trash-alt nav-icon"></i>
                Trash Post
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table table-hover">
                <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Excerpt</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($posts as $key => $post)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->excerpt }}</td>
                            <td>
                                @if ($post->status == 'Publish')
                                    <li class="text-success">Publish</li>
                                @else
                                <li class="text-danger">Unpublish</li>
                                @endif
                            </td>
                            <td><img src="{{ asset('source/back/post') }}/{{ $post->postImage }}" class="rounded-circle" alt="post image" width="120px" height="120px"></td>
                            <td>
                                <a href="{{ route('post.delete',$post->id) }}" title="Delete" class="btn text-danger">
                                    <i class="fas fa-trash nav-icon"></i>
                                </a>
                                <a href="{{ route('post.edit',$post->id) }}" title="Edit" class="btn text-success">
                                    <i class="fas fa-edit nav-icon"></i>
                                </a>
                                @if($post->status == 'Publish')
                                    <a href="{{ route('post.hide',$post->id) }}" title="Click to Unpublish" class="btn text-success">
                                        <i class="fas fa-arrow-up nav-icon"></i>
                                    </a>
                                @else
                                <a href="{{ route('post.publish',$post->id) }}" title="Click to Publish" class="btn text-danger">
                                    <i class="fas fa-arrow-down nav-icon"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection
