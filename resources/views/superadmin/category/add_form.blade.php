@extends('superadmin.master')
@section('title')
    Super Admin || Category Add
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category Generate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('category.index') }}" class="card-title">
                    <i class="fas fa-list nav-icon"></i>
                    Category List
                </a>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  @include('superadmin.include.alert')
                  <div class="card">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputName">Name</label>
                          <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Write a Category Name">
                        </div>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                    </form>
                  </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
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
    <script>

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
