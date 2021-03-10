@extends('superadmin.master')
@section('title')
    Super Admin || Subscriber
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Subscriber Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{ route('subscriber.index') }}">Subscriber</a></li>
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
              <h3 class="card-title">Subscriber</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-hover" >
                <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($subscribers as $key => $subscriber)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $subscriber->email }}</td>
                            <td>
                                <a href="{{ route('subscriber.destroy',$subscriber->id) }}" title="Delete" class="btn text-danger">
                                    <i class="fas fa-trash nav-icon"></i>
                                </a>
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
