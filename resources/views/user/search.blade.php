@extends('user.layouts.master')
@section('title')
{{ 'Search for'." ".$query }}
@endsection
@section('customCSS')
	<link href="{{asset('user/front-page-category/css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('user/front-page-category/css/responsive.css')}}" rel="stylesheet">
	<style>
        .header-bg{
			height:400px;
			width:100%;
			background-image:url({{ asset('source/back/category/catDefault.jpg') }});
			background-size:cover;
		}
		.favorite_posts{
			color:red;
		}
	</style>
@endsection

@section('content')
    <div class="header-bg">
        <div class="display-table center-text">
            <h1 class="title display-table-cell text-white"><b class="text-primary">{{ $posts->count() }}</b> Results found for <b class="text-primary">{{ $query }}</b></h1>
        </div>
    </div>

    <section class="blog-area section">
        <div class="container">

            <div class="row">
				@foreach($posts as $key => $post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							{{-- <div class="blog-image"><img src="{{asset('user/images/marion-michele-330691.jpg')}}" alt="Blog Image"></div> --}}
							<div class="blog-image"><img src="{{asset('source/back/post').'/'.$post->postImage}}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="{{asset('source/back/profile')}}/{{ $post->user->profileImage }}" alt="Profile Image"></a>

							<div class="blog-info">
								<h4 class="title"><a href="{{route('user.single-blog', $post->id)}}"><b>{{$post->title}}</b></a></h4>

								<ul class="post-footer">
									<li>
										@guest
											<a href="javascript:void(0);"onclick="toastr.success('To add favorite list. You have to login first.','Info',{
												closeButton: true,
												progressBar: true,
											})"><i class="fas fa-heart"></i>{{ $post->favorite_to_users->count() }}</a>
										@else
											<a href="{{ route('post.favorite',$post->id) }}" class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="fas fa-heart"></i>{{ $post->favorite_to_users->count() }}</a>
										@endguest
										
									</li>
									<li><a href="{{route('user.single-blog', $post->id)}}"><i class="far fa-comment"></i>{{ $post->comments()->count() }}</a></li>
									<li><a href="{{route('user.single-blog', $post->id)}}"><i class="far fa-eye"></i>{{ $post->view_count }}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
				@endforeach
			</div><!-- row -->

            {{--{{ $posts->links() }}--}}

        </div><!-- container -->
    </section><!-- section -->

@endsection