@extends('superadmin.master')
@section('title')
    Admin || User
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User Role Update</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('manage.index') }}" class="card-title">
                    <i class="fas fa-list nav-icon"></i>
                    Active User List
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
                    <form action="{{ route('manage.update',[$user->id]) }}" method="POST">
                        @csrf
                        @method('put')
                      <div class="card-body">
                        <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Change User Role</label>
                            <select class="custom-select " name="type">
                                <option value="0" selected>Select a role</option>
                                @forelse($roles as $role)
                                <option value="{{ $role->roleName }}">{{ $role->roleName }}</option>
                                @empty
                                @endforelse
                            </select>
                          </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
  </section>

@endsection
