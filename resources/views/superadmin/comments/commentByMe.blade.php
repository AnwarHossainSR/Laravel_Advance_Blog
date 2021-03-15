@extends('superadmin.master')
@section('title')
    Admin || Manage Self Comments
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
                    <li class="breadcrumb-item "><a href="{{ route('comment.index') }}">Comment</a></li>
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
                                    <a href="{{ route('manage.show',$comment->user->id) }}">
                                        <img class="media-object" src="{{ asset('source/back/profile') }}/{{ $comment->user->profileImage }}" style="clip-path: circle();" alt="User image" width="50px" height="50px">
                                    </a>
                                </div>
                                <div class="media-body ml-2">
                                    <a href="{{ route('manage.show',$comment->user->id) }}" class="media-heading text-primary">{{ $comment->user->name }}
                                      <small class="text-secondary ml-2">{{ $comment->created_at->diffForHumans() }}</small> 
                                    </a>
                                    <p>{{ $comment->comment }}</p>
                                    <a target="_blank" href="{{ route('user.single-blog',$comment->post->id) }}"><i class="fas fa-reply text-secondary" title="reply"></i></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="media">
                                <div class="media-right">
                                    <a target="_blank" href="{{ route('post.show',$comment->post->id) }}">
                                        <img class="media-object" src="{{ asset('source/back/post') }}/{{ $comment->post->postImage }}" style="clip-path: circle();" alt="post image" width="50px" height="50px">
                                    </a>
                                </div>
                                <div class="media-body ml-2">
                                    <a target="_blank" href="{{ route('user.single-blog',$comment->post->id) }}">
                                        <h4 class="media-heading">{{ \Illuminate\Support\Str::limit($comment->post->title,'20') }}</h4>
                                    </a>
                                    <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                </div>
                            </div>
                        </td>
                        <td>
                              <i class="fas fa-trash-alt fa-2x nav-icon text-danger" title="Delete" onclick="deleteComment({{ $comment->id }})" style="cursor: pointer;"></i>
                            <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ route('comment.destroy',$comment->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
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
@section('script')
    <!-- sweet Alart CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    <script>
        function deleteComment(id) { 
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this from trash!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            event.preventDefault();
            document.getElementById('delete-form-'+id).submit();
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your post is safe :)',
              'error'
            )
          }
        })
      }
    </script>
@endsection
