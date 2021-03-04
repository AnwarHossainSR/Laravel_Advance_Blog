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
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
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
                    <a href="{{ url('profile/superadmin/password/change/'. Auth::user()->id) }}" class=" ">
                      <i class="fas fa-unlock "></i>
                      Change Password
                    </a>
                  </h5>
              </div><!-- /.card-header -->
              <div class="pl-3 pr-3">
                @include('superadmin.include.alert')
              </div>
              <!-- form start -->
              <form role="form" action="{{ route('password.update') }}" method="POST">
              @csrf
                <div class="card-body">
                  <input class="form-control" type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                    <div class="form-group">
                        <label for="exampleInputName">Previous Password</label>
                        <input type="password" name="previousPassword" class="form-control @error('previousPassword') is-invalid @enderror" id="exampleInputName" placeholder="Previous Password">
                      </div>
                    @error('previousPassword')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                    <div class="form-group">
                        <label for="exampleInputName">New Password</label>
                        <input type="password" name="password" class="form-control @error('newPassword') is-invalid @enderror" id="exampleInputName" placeholder="New password">
                      </div>
                    @error('newPassword')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                    <div class="form-group">
                        <label for="exampleInputName">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputName" placeholder="Confirm password" >
                      </div>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                      
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
