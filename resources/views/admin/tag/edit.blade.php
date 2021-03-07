@extends('admin.master')

@section('title')
    Admin || Tag
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Edit Tag</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.tags.all') }}">Tag list</a></li>
                    <li class="breadcrumb-item active">Edit Tag</li>
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
                            <h3 class="card-title">Edit tag</h3>
                            <a href="{{ route('admin.tags.all') }}" class="btn btn-primary">Go Back to Tag List</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                                <form action="{{ route('admin.tag.edit',[$tags->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        @include('include.alert')
                                        <div class="form-group">
                                            <label for="name">Tag name</label>
                                            <input type="text" name="name" class="form-control" id="name" value="{{ $tags->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Slug</label>
                                            <textarea name="slug" id="slug" rows="4" class="form-control"
                                            >{{ $tags->slug }}</textarea>

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

