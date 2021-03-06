@extends('superadmin.master')
@section('title')
    Super Admin || Users
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Active Users Page</h1>
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
              <h3 class="card-title">Users</h3>
              <a href="{{ route('manage.create') }}" class="card-title float-right">
                <i class="fas fa-plus-circle nav-icon"></i>
                Add Roles
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-hover" >
                <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Type</th>
                  <th>Image</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->active == 1)
                                    <li class="text-success">Active</li>
                                @endif
                            </td>
                            <td>{{ $user->type }}</td>
                            <td><img src="{{ asset('source/back/profile') }}/{{ $user->profileImage }}" class="rounded-circle" alt="User Image" width="100px" height="100px"></td>
                            <td>
                                <a href="{{ route('manage.show',$user->id) }}" title="Click to show Details" class="btn text-primary">
                                  <i class="fas fa-info-circle nav-icon"></i>
                                </a>
                                <a href="{{ route('manage.edit',$user->id) }}" title="Change user role" class="btn text-success">
                                    <i class="fas fa-edit nav-icon"></i>
                                </a>
                                @if($user->active == 1)
                                    <a href="{{ route('activeuser.deactive',$user->id) }}" title="Click to Deactive" class="btn text-danger">
                                        <i class="fas fa-user-slash nav-icon"></i>
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
