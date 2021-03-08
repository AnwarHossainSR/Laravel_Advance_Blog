@extends('superadmin.master')
@section('title')
    Admin || Post
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Your Total Post : <span class="text-info">{{ $posts->count() }}</span></h1>
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
                  <th>Author</th>
                  <th><i class="far fa-eye text-primary"></i></th>
                  <th>isApprove</th>
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
                            <td>{{ \Illuminate\Support\Str::limit($post->title, 10) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->view_count }}</td>
                            <td>
                              @if ($post->is_approve == true)
                                    <li class="badge bg-blue">Approved</li>
                                @else
                                    <li class="badge bg-pink">Pending</li>
                                @endif
                            </td>
                            <td>
                                @if ($post->status == 'Publish')
                                    <li class="text-success">Published</li>
                                @else
                                <li class="text-danger">Unpublished</li>
                                @endif
                            </td>
                            <td><img src="{{ asset('source/back/post') }}/{{ $post->postImage }}" class="rounded-circle" alt="post image" width="120px" height="120px"></td>
                            <td>
                                <a href="{{ route('post.show',$post->id) }}" title="Post Details" class="btn text-primary">
                                    <i class="fas fa-info-circle nav-icon"></i>
                                </a>
                                <a href="{{ route('post.edit',$post->id) }}" title="Post Edit" class="btn text-success">
                                    <i class="fas fa-edit nav-icon"></i>
                                </a>
                                
                                <i class="fas fa-trash nav-icon text-danger" title="Delete" onclick="deletePost({{ $post->id }})" style="cursor: pointer;"></i>
                                
                                <form id="delete-form-{{ $post->id }}" method="POST" action="{{ route('post.destroy',$post->id) }}"  style="display:none;">
                                    @csrf
                                    @method('delete')
                                </form>
                                
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

@section('script')
    <!-- sweet Alart CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    <script>
        function deletePost(id) { 
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
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

