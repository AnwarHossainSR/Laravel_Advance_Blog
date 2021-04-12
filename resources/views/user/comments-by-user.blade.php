@extends('user.layouts.dashboard-master')

@section('title')
    User || Favourite Post
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">All your Comments : <span class="text-info">{{ $comments->count() }}</span></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="#">Comment</a></li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table table-hover">
                <thead class="table-light">
                <tr>
                  <th>Comment info</th>
                  <th>Post info</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($comments as $key=>$comment)
                      <tr>
                        <td>
                            <div class="media">
                                <div class="media-left">
                                    
                                        <img class="media-object" src="{{ asset('source/back/profile') }}/{{ $comment->user->profileImage }}" style="clip-path: circle();" alt="User image" width="50px" height="50px">
                                    
                                </div>
                                <div class="media-body ml-2">
                                    <p class="media-heading text-primary">{{ $comment->user->name }}
                                      <small class="text-secondary ml-2">{{ $comment->created_at->diffForHumans() }}</small> 
                                    </p>
                                    <p>{{ $comment->comment }}</p>
                                    
                                </div>
                            </div>
                        </td>
                        
                        <td>
                            <div class="media">
                                <div class="media-right">
                                    <a href="{{ route('user.single-blog',$comment->post->id) }}">
                                        <img class="media-object" src="{{ asset('source/back/post') }}/{{ $comment->post->postImage }}" style="clip-path: circle();" alt="post image" width="50px" height="50px">
                                    </a>
                                </div>
                                <div class="media-body ml-2">
                                    <a href="{{ route('user.single-blog',$comment->post->id) }}">
                                        <h4 class="media-heading">{{ \Illuminate\Support\Str::limit($comment->post->title,'20') }}</h4>
                                    </a>
                                    <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{route('comments.delete', $comment->id)}}"><i class="fas fa-trash-alt fa-2x nav-icon text-danger" title="Delete"></i></a>
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

