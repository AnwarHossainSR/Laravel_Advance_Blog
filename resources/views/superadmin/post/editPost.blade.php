@extends('superadmin.master')
@section('title')
    Super Admin || Post
@endsection
@push('css')
  <link href="{{ asset('source/back') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
  <script src="https://cdn.tiny.cloud/1/qbghu4tnq16uzuojk6all9lci25ogff0uz85m2o6933y2ryk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post Edit</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('superadmin.post.singleuser') }}" class="card-title">
                    <i class="fas fa-list nav-icon"></i>
                   Post List
                </a>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
              <div class="row">
                @include('superadmin.include.alert')
                <!-- left column -->
                <div class="col-md-8">
                  <!-- general form elements -->
                  <div class="card">
                    
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                      <div class="card-body">
                        <input type="text" name="is_approve" class="form-control" value="1" hidden>
                        <div class="form-group">
                          <label for="exampleInputName">Title</label>
                          <input type="text" class="form-control" name="title" id="exampleInputName" value="{{ $post->title }}" placeholder="Write a title ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Excerpt</label>
                            <input type="text" class="form-control" name="excerpt" id="exampleInputName" value="{{ $post->excerpt }}" placeholder="Write an excerpt" >
                          </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!--/.col (left) -->
                 <!--.col (right) -->
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-group">
                        <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                            <label for="category">Select Categories</label>
                            <select name="categories[]" id="category" class="form-control selectpicker show-tick " data-live-search="true" data-max-options="3" multiple>
                                @foreach($categories as $category)
                                    <option 
                                        @foreach($post->categories as $postCategory)
                                            {{ $postCategory->id == $category->id ? 'selected':'' }}
                                        @endforeach
                                        value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                            <label for="tag">Select Tags</label>
                            <select name="tags[]" id="tag" class="form-control selectpicker show-tick"  data-live-search="true" data-max-options="3" multiple>
                                @foreach($tags as $tag)
                                    <option
                                        @foreach($post->tags as $postTag)
                                            {{ $postTag->id == $tag->id ? 'selected':'' }}
                                        @endforeach
                                        value="{{ $tag->id }}">{{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 <!--/.col (right) -->
              </div>
              <!-- /.row -->

              <!--row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <!-- /.card-header -->
                      <!-- form start -->
                      
                        <div class="card-body">
                          <div class="md-form">
                            <label >Content</label>
                            <textarea id=""  name="content" class="md-textarea form-control" rows="3">{{ $post->content }}</textarea>
                          </div><br>
                            <div class="form-group-file">
                              <input type="file" name="feature_image" accept="image/*" id="file-upload" class="form-control" name="file" style="display: none;" onchange="previewFile(this)">
                              <p onclick="document.querySelector('#file-upload').click()">
                                  Drag & drop to upload image
                              </p>
  
                            </div>
                          <div id="previewBox" style="display: none;">
                              <img src="" id="previewImg" alt="" width="40%" height="50%">
                              <i class="fas fa-trash-alt nav-icon" style="cursor: pointer;" onclick="previewRemove()">Delete</i>
                          </div>
                          <div class="card-footer">
                              @if($post->status == 'Publish')
                                <button type="submit" name="status" class="btn btn-success" value="Publish">Publish Post</button>
                              @else
                                <button type="submit" name="status" class="btn btn-primary" value="Unpublish">Save Post</button>
                              @endif
                            </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
              <!--/row-->
            </form>
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
      </section>


@endsection

@section('style')
  <style>
      .form-group-file{
          width: 100%;
          height: 150px;
          border: 1px dashed !important;
          margin-bottom: 10px;
      }
      .form-group-file{
          width: 100%;
          height: 100%;
          text-align: center;
          line-height: 178px;
      }

  </style>
@endsection

@section('script')
    <!-- Select Plugin Js -->
    <script src="{{ asset('source/back') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- TinyMCE -->
    {{-- <script src="{{ asset('source/back') }}/plugins/tinymce/tinymce.js"></script> --}}

<script>

tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});



        function previewFile(input)
        {
            let file = $("input[type=file]").get(0).files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(){
                    $('#previewImg').attr('src',reader.result);
                    $('#previewBox').css('display','block');
                }
                $('.form-group-file').css('display','none');
                reader.readAsDataURL(file);
            }
        }

        function previewRemove(input)
        {
            $('#previewImg').attr('src','');
            $('#previewBox').css('display','none');
            $('.form-group-file').css('display','block');
        }
    </script>
@endsection

