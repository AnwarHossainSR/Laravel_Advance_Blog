@extends('superadmin.master')
@section('title')
    Admin || Post
@endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Total Unread Notifications : <span class="text-info">{{ Auth::user()->unreadNotifications->count() }}</span></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="{{ route('superadmin.notifications') }}">Notification</a></li>
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
            <!-- /.card-header -->
            <div class="card-body">
                @php($i=1)
                    @if($notifications->count() > 0)
                            <table class="table table table-hover">
                                <thead class="table-light">
                                <tr>
                                <th>#</th>
                                <th>Notification</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $key => $notification)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            @if($notification->type == "App\Notifications\superAdmin\NewPostNotification")
                                                <span class="text-bold text-primary">New Post Notification, click to view</span>
                                            @elseif($notification->type ==  "App\Notifications\superAdmin\NewUserNotification")
                                            <span class="text-bold text-primary">{{ $notification->data['user'] }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($notification->type == "App\Notifications\superAdmin\NewPostNotification")
                                                <a href="{{ route('post.show',$notification->data['post']['id']) }}" title="Post Details" class="btn text-primary">
                                                <i class="fas fa-2x fa-info-circle nav-icon"></i>
                                            </a>
                                            @elseif($notification->type ==  "App\Notifications\superAdmin\NewUserNotification")
                                            <a href="{{ route('manage.index') }}" title="User Details" class="btn text-primary">
                                                <i class="fas fa-2x fa-info-circle nav-icon"></i>
                                            </a>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                    @else
                        <h2 class="text-secondary text-center">There is no new notifications</h2>
                    @endif
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

