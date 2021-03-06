@extends('superadmin.master')
@section('title')
    Super Admin || User roles
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Role manage</h1>
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
                Create Roles
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-hover" >
                <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Created</th>
                  <th>Updated</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($roles as $key => $role)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $role->roleName }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
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
