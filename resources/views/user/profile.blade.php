@extends('user.layouts.dashboard-master')

@section('title')
    User || Profile
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Profile</h3>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12 col-lg-9">
                                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @include('include.alert')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name">User name</label>
                                                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $user->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">User email</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $user->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">User password<small class="text-info">(Enter password if you want change.)</small></label>
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="image">User image</label>
                                                        <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div style="height: 200px; width: 200px; overflow:hidden;" class="m-auto">
                                            <img src="{{ asset('source/back/profile') }}/{{ $user->profileImage }}" alt="" class="img-fluid rounded-circle img-rounded">
                                        </div>
                                        <div class="mt-2">
                                            <h5>{{ $user->name }}</h5>
                                            <p> {{ $user->email }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

