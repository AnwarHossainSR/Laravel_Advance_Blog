@extends('author.master')
@section('title')
    Author || Post Section
@endsection

@section('content')

<!-- Content Header (Page header) -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>New Post Area</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('AuthorPostController.all_post_show')}}">View all Post</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  @include('author.include.alert')
                  <div class="card">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                        <input type="text" name="user_id" class="form-control" value="{{ Auth::user()->id }}" name="id" hidden>
                        <div class="form-group">
                          <label for="exampleInputName">Title</label>
                          <input type="text" class="form-control" name="title"  value="{{$post->title}}" id="exampleInputName" placeholder="Post Title ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Excerpt</label>
                            <input type="text" class="form-control" name="excerpt" value="{{$post->excerpt}}" id="exampleInputName" placeholder="Excerpt or quote">
                          </div>
                          <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Category</label>
                            <select class="custom-select " name="category_id">
                                
                             @foreach ($categories as $category)
                              
                               <option 
                               
                               @foreach ($post->categories as $postCategory)
                                    
                                      {{$postCategory->id == $category->id? 'selected': ' '}}
                                   
                               @endforeach 
                               
                               
                               value="{{ $category->id }}">{{ $category->name }}</option>  
                            
                             @endforeach


                            </select>
                          </div>

                          <div class="form-group-file">
                            <label >Feature Image</label>
                            <input type="file" name="feature_image"   value="{{$post->feature_image}} " selected id="file-upload" class="form-control">

                          </div>


                        <div class="form-group-file">
                          <div class="card-body pad">
                            <div class="mb-3">
                                <label >Writhing Area</label>
                               
                                <textarea name="content" id="content"  rows="4" class="form-control" placeholder="Write Someting Amaizing....."> {{$post->content}} </textarea>
                            </div>
                        </div>
                        </div>



                        <div class="card-footer">
                            <button type="submit" name="status" class="btn btn-primary" value="unpublish">Submit Post</button>
                          </div>
                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!--/.col (right) -->
              </div>
              @endsection

              
 @section('style')
<link rel="stylesheet" href="{{asset('/author/css/summernote-bs4.min.css')}}">
@endsection

@section('script')
<script src="{{asset('/author/js/summernote-bs4.min.js')}}"></script>
<script>
  $('#content').summernote({
    placeholder: 'Hello Bootstrap 4',
    tabsize: 2,
    height: 200
  });
</script>


@endsection 