@extends('superadmin.master')
@section('title')
    Super Admin || Deactive Users
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Deactive Users Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{ route('manage.index') }}">Users</a></li>
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
              <h3 class="card-title">Deactive Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-hover" >
                <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Type</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if ($user->active == 0)
                                    <li class="text-danger">Deactive</li>
                                @endif
                            </td>
                            <td>{{ $user->type }}</td>
                            <td><img src="{{ asset('source/back/profile') }}/{{ $user->profileImage }}" class="rounded-circle" alt="User Image" width="100px" height="100px"></td>
                            <td>
                                @if($user->active == 0)
                                    <a href="{{ route('deactiveuser.active',$user->id) }}" title="Click to Active" class="btn text-success">
                                      <i class="fas fa-trash-restore-alt fa-2x nav-icon"></i>
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
