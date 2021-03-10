@extends('admin.master')

@section('title')
    Admin || Post
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Edit Post</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.all') }}">Post list</a></li>
                    <li class="breadcrumb-item active">Edit Post</li>
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
                            <h3 class="card-title">Edit Post</h3>
                            <a href="{{ route('admin.posts.all') }}" class="btn btn-primary">Go Back to Post List</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                                <form action="{{ route('admin.post.edit',[$posts->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        @include('include.alert')
                                        <div class="form-group">
                                            <label for="name">Post Title</label>
                                            <input type="text" name="title" class="form-control" id="name" placeholder="Enter Post title" value="{{ $posts->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Slug</label>
                                            <textarea name="slug" id="slug" rows="2" class="form-control"
                                                placeholder="Enter slug">{{ $posts->slug }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Excerpt</label>
                                            <textarea name="excerpt" id="excerpt" rows="2" class="form-control"
                                                placeholder="Enter excerpt">{{ $posts->excerpt }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Content</label>
                                            <textarea name="content" id="content" rows="2" class="form-control"
                                                placeholder="Enter content">{{ $posts->content }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Category</label>
                                            <select class="form-select form-control" aria-label="Default select example" name="category">
                                                @foreach ($category as $item)
                                                <option value="{{ $item->id }}" @if($item->id == $cat->id) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Choose Post Tags</label>
                                            <div class=" d-flex flex-wrap">
                                                @foreach($tags as $tag)
                                                <div class="custom-control custom-checkbox" style="margin-right: 20px">
                                                    <input class="custom-control-input" name="tags[]" type="checkbox" id="tag{{ $tag->id}}" value="{{ $tag->id }}" @foreach($posts->tags as $t)
                                                    @if($tag->id == $t->id) checked @endif
                                                @endforeach>

                                                    <label for="tag{{ $tag->id}}" class="custom-control-label">{{ $tag->name }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="exampleInputPassword1">Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="file" value="{{ $posts->image }}">
                                            <label class="custom-file-label" for="customFile">Choose image</label>
                                          </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <label for="image">Image</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file" class="custom-file-input" id="image">
                                                    <label class="custom-file-label" for="image">Choose image</label>
                                                </div>
                                            </div>
                                            <div class="col-4 text-right">
                                                <div style="max-width: 100px; max-height: 100px;overflow:hidden; margin-left: auto">
                                                    <img src="{{ asset('/upload') }}/{{ $posts->postImage }}" class="img-fluid" alt="">
                                                </div>
                                            </div>
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

@section('csstyle')
    <link rel="stylesheet" href="{{ asset('/admin/css/summernote-bs4.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/admin/js/summernote-bs4.js') }}"></script>
    <script>
        $('#content').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 200
        });
    </script>
@endsection
