@extends('user.layouts.master')
@section('title', 'Home')
@section('customCSS')
    
    <link href="{{asset('user/category/css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('user/category/css/responsive.css')}}" rel="stylesheet">
	<style>
		.favorite_posts{
			color:red;
		}
	</style>
@endsection
@section('content')

	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b></b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">
                @foreach($category as $key => $post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{asset('source/back/post').'/'.$post->postImage}}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="images/icons8-team-355979.jpg" alt="Profile Image"></a>

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
									<li><a href="#"><i class="far fa-comment"></i>6</a></li>
									<li><a href="#"><i class="far fa-eye"></i>{{ $post->view_count }}</a></li>
								</ul>
							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
                @endforeach

				

				

			</div><!-- row -->

			<a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

		</div><!-- container -->
	</section><!-- section -->


@endsection