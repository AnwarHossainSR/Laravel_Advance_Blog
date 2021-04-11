@extends('author.master')
@section('title')
    Author || Edit Post Section
@endsection

@section('content')

<!-- Content Header (Page header) -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Post Area</h1>
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
         
                  <div class="card">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('AuthorPostController.update_post',$post->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                        <input type="text" name="user_id" class="form-control" value="{{ Auth::user()->id }}" name="id" hidden>
                        <div class="form-group">
                          <label for="exampleInputName">Title</label>
                          <input type="text" class="form-control" name="title"  value="{{$post->title}}" id="exampleInputName" placeholder="Post Title ">
                        
                          @if ($errors->has('title'))
                          <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                        
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Excerpt</label>
                            <input type="text" class="form-control" name="excerpt" value="{{$post->excerpt}}" id="exampleInputName" placeholder="Excerpt or quote">
                         
                            @if ($errors->has('excerpt'))
                            <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                            @endif
                         
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

                                                    
                          <div class="form-group">
                            <label class="mr-sm-2">Tags</label>
                            {{-- tags[] name must be at first position --}}
                            <select name="tags[]"  class="select2"   multiple="multiple" data-placeholder="Select a tag" style="width: 100%;">
                              @foreach($tags as $tg)
                              <option
                              
                              @foreach ($post->tags as $ptag)
                              
                                   {{$ptag->id == $tg->id? 'selected': ' '}}
                          
                              @endforeach
                              
                              
                              value="{{ $tg->id }}"> {{ $tg->name }}</option>
    
                              @endforeach

                            </select>
                          </div>



                          <div class="form-group row">
                            <div class="ml-2 col-sm-6">
                              <div id="msg"></div>
                            
                                <input type="file" value="{{old('feature_image')}}" name="feature_image" class="file" accept="image/*">
                                <div class="input-group my-3">
                                  <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                                  <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Browse...</button>
                                  </div>
                                </div>
                              
                            </div>
                            <div class="ml-2 col-sm-6">
                              <img src="{{asset('/source/back/post')}}/{{$post->postImage}}" id="preview" class="img-thumbnail">
                            </div>
        
                           </div>




                        <div class="form-group-file">
                          <div class="card-body pad">
                            <div class="mb-3">
                                <label >Writhing Area</label>
                               
                                <textarea name="content" id="content"  rows="4" class="form-control" placeholder="Write Someting Amaizing....."> {{$post->content}} </textarea>
                            
                                @if ($errors->has('content'))
                                <span class="text-danger">{{ $errors->first('content') }}</span>
                                @endif
                            
                              </div>
                        </div>
                        </div>



                        <div class="card-footer">
                            <button type="Update" name="status" class="btn btn-primary" value="Unpublish">Submit Post</button>
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
            <style >
            
              .file {
                visibility: hidden;
                position: absolute;
              }
            
            </style>
          
          
          <style>
          .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #40bf80;
            border-color: #006fe6;
            color: #ffffff;
            padding: 0 10px;
            margin-top: .31rem;
          }
          }
          </style>
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
          
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
          
          
                <script>
                $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
          });
          $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);
          
            var reader = new FileReader();
            reader.onload = function(e) {
              // get loaded data and render thumbnail.
              document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
          });  
                </script>
          
          @endsection