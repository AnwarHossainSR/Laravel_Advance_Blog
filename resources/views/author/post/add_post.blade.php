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
                  {{-- @include('author.include.alert') --}}
                  <div class="card">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('AuthorPostController.store_new_post')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                        <input type="text" name="user_id" class="form-control" value="{{ Auth::user()->id }}" name="id" hidden>
                        <div class="form-group">
                          <label for="exampleInputName">Title</label>
                          <input type="text" class="form-control" name="title"  value="{{old('title')}}" id="exampleInputName" placeholder="Post Title ">
                            
                          @if ($errors->has('title'))
                                 <span class="text-danger">{{ $errors->first('title') }}</span>
                           @endif
                        
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Excerpt</label>
                            <input type="text" class="form-control" name="excerpt" value="{{old('excerpt')}}" id="exampleInputName" placeholder="Excerpt or quote">
                          
                                                      
                            @if ($errors->has('excerpt'))
                            <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                            @endif

                          </div>
                          <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Category</label>
                            <select class="custom-select " name="category_id">
                                <option value="0" style="display: none" selected>Select a category</option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                @endforelse
                            </select>
                          </div>

                          
                            <div class="form-group">
                              <label class="mr-sm-2">Tags</label>
                              {{-- tags[] name must be at first position --}}
                              <select name="tags[]" value="{{old('tags[]')}}" class="select2"   multiple="multiple" data-placeholder="Select a tag" style="width: 100%;">
                                @forelse($tags as $tg)
                                <option value="{{ $tg->id }}"> {{ $tg->name }}</option>
                                @empty
                                @endforelse
  
                              </select>
                            </div>


                          <div class="form-group-file">
                            <label >Feature Image</label>
                            <input type="file" name="feature_image"   value="{{old('feature_image')}}" id="file-upload" class="form-control">

                          </div>

                          <div class="form-group-file">
                          <div class="card-body pad">
                            <div class="mb-3">
                                <label >Writhing Area</label>
                               
                                <textarea name="content" id="content"  rows="4" class="form-control" placeholder="Write Someting Amaizing.....">  </textarea>

                                                            
                          @if ($errors->has('content'))
                          <span class="text-danger">{{ $errors->first('content') }}</span>
                          @endif
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
    

      <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('/source/back/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('/source/back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  @endsection

@section('script')
    <script src="{{asset('/author/js/summernote-bs4.min.js')}}"></script>
    <script>
      $('#content').summernote({
        placeholder: 'Write Someting Amaizing.....',
        tabsize: 2,
        height: 200
      });
    </script>



<script>
  $(function () {
     //Initialize Select2 Elements
     $('.select2').select2()

  })
</script>

<script src="{{ asset('source/back/plugins/select2/js/select2.full.min.js') }}"></script> 

@endsection