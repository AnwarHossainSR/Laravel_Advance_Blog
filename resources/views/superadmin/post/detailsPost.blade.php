@extends('superadmin.master')
@section('title')
    Super Admin || Post
@endsection
@push('css')
  <link href="{{ asset('source/back') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
  <script src="https://cdn.tiny.cloud/1/qbghu4tnq16uzuojk6all9lci25ogff0uz85m2o6933y2ryk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('post.index') }}" class="card-title">
                    <i class="fas fa-list nav-icon"></i>
                    Post List
                </a>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row clearfix">
                @include('superadmin.include.alert')
                <!-- left column -->
                <div class="col-md-8">
                  <!-- general form elements -->
                  <div class="card">
                    <div class="card-header ">
                        <div class="">
                            <h2>{{ $post->title }}</h2>
                        <small>Posted By : 
                            <strong>
                                <a href="">
                                    {{ $post->user->name }}
                                </a>
                                on {{ $post->created_at->toFormattedDateString() }}
                            </strong>
                        </small>
                        </div>
                        <div class="float-right" style="margin-top: -25px;">
                            @if ($post->is_approve == true)
                                <li class="fas fa-check badge bg-blue p-2">Approved</li>
                            @else
                                <li class="badge bg-pink p-2">Pending</li>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $post->content !!}
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <!--/.col (left) -->
                 <!--.col (right) -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-cyan">
                            Categories
                        </div>
                        <div class="card-body">
                            @foreach($post->categories as $key => $category)
                                <span class="badge bg-cyan">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-green">
                            Tags
                        </div>
                        <div class="card-body">
                            @foreach($post->tags as $key => $tag)
                                <span class="badge bg-green">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-secondary">
                            Feature Image
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('source/back/post') }}/{{ $post->postImage }}" alt="Feature Image" srcset="" width=100% height=100%>
                        </div>
                    </div>
                </div>
                 <!--/.col (right) -->
              </div>
              <!-- /.row -->

            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
      </section>


@endsection




