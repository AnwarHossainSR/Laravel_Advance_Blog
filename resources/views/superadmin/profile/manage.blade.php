@extends('superadmin.master')
@section('title')
    Super Admin || Profile
@endsection

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Super Admin Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('source/back/profile') }}/{{ Auth::user()->profileImage }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Total Post</b> <a class="float-right text-primary">{{ count($user->posts) }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Comment</b> <a class="float-right text-primary">{{ $user->comments->count() }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Joined</b> <a class="float-right text-primary">{{ Auth::user()->created_at->toFormattedDateString() }}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="p-1 px-3 d-flex justify-content-between">
                  <h3 class="">Profile Edit</h3>
                  <h5>
                    <a href="{{ route('profile.passChange') }}" class=" ">
                      <i class="fas fa-unlock "></i>
                      Change Password
                    </a>
                  </h5>
              </div><!-- /.card-header -->
              <div class="pl-3 pr-3">
                @include('superadmin.include.alert')
              </div>
              <!-- form start -->
              <form role="form" action="{{ route('user.update',[Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('put')
                <div class="card-body">
                  <input class="form-control" type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                    <div class="form-group">
                        <label for="exampleInputName">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="full name" name="name" value="{{ Auth::user()->name }}">
                      </div>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" placeholder="Enter email" value="{{ Auth::user()->email }}">
                  </div>
                   @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <div class="form-group">
                      <label for="exampleInputAbout">About Me</label>
                      <textarea type="text" name="about" class="form-control @error('about') is-invalid @enderror" id="exampleInputAbout" name="about" placeholder="Enter email">{{ Auth::user()->about }}</textarea>
                    </div>
                     @error('about')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    <label >Image Upload</label>
                  <div class="form-group-file">
                    
                    {{-- <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="feature_image" accept="image/*" class="custom-file-input" name="file" >
                        <label class="custom-file-label">Profile Image</label>
                      </div>
                    </div> --}}
                      <input type="file" name="feature_image" accept="image/*" id="file-upload" class="form-control" name="file" style="display: none;" onchange="previewFile(this)">
                      <p onclick="document.querySelector('#file-upload').click()">
                          Drag & drop to upload image
                      </p>
                  </div>
                  <div id="previewBox" style="display: none;">
                    <img src="" id="previewImg" alt="" width="40%" height="50%">
                    <i class="fas fa-trash-alt nav-icon" style="cursor: pointer;" onclick="previewRemove()">Delete</i>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('style')
  <style>
      .form-group-file{
          width: 100%;
          height: 50px;
          border: 1px dashed !important;
          margin-bottom: 5px;
      }
      .form-group-file{
          width: 100%;
          height: 100%;
          text-align: center;
          line-height: 100px;
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