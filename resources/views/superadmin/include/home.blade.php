@extends('superadmin.master')

@section('title')
    Admin || Dashboard
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-green">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ $posts->count() }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>Total Posts</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-pen-square"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-cyan">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ Auth::user() ->favorite_posts()->count() }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>Total Favorite</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-heart"></i>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-red">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ $total_pending_posts }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>PENDING POSTS</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-icicles"></i>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-orange">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ $all_views }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>TOTAL VIEWS</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-eye"></i>
                    </div>
                </div> 
            </div>
        </div>
        <!-- /.row -->
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="small-box bg-pink">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ $category_count }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>CATEGORIES</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-affiliatetheme"></i>
                    </div>
                </div> 
                <div class="small-box bg-yellow">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ $tag_count }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>TAGS</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
                <div class="small-box bg-purple">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ $author_count }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>TOTAL AUTHOR</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-friends"></i>
                    </div>
                </div>
                <div class="small-box bg-secondary">
                    <div class="inner">
                      <h5 class="number count-to" data-from="0" data-from="0" data-to="{{ $new_user_today }}" data-speed="1000" data-fresh-interval="20"></h5>
                      <p>TODAY User</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-pen-square"></i>
                    </div>
                </div> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="card">
                    <div class="header bg-secondary">
                        <h2 class="text-white text-center">Most Popular Post</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Favorite</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($post->title,'20') }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>{{ $post->favorite_to_users_count }}</td>
                                            <td>{{ $post->comments_count }}</td>
                                            <td>
                                                @if($post->status == true)
                                                    <li class="text-success">Published</li>
                                                @else
                                                <li class="text-warning">Unpublished</li>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('post.show',$post->id) }}" title="Post Details" class="btn text-primary">
                                                    <i class="fas fa-info-circle nav-icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('script')
<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

<!-- Morris Plugin Js -->
{{-- <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }}"></script> --}}

<!-- ChartJs -->
{{-- <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script> --}}

<!-- Flot Charts Plugin Js -->
{{-- <script src="assets/backend/plugins/flot-charts/jquery.flot.js"></script>
<script src="assets/backend/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="assets/backend/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="assets/backend/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="assets/backend/plugins/flot-charts/jquery.flot.time.js"></script> --}}

<!-- Sparkline Chart Plugin Js -->
<script src="assets/backend/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endsection
