@extends('user.layouts.master')
@section('title', 'Home')
@section('customCSS')
	<link href="{{asset('user/single-post-1/css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('user/single-post-1/css/responsive.css')}}" rel="stylesheet">
	<style>
		.header-bg{
			height:400px;
			width:100%;
			background-image:url({{ asset('source/back/post/'.$post->postImage) }});
			background-size:cover;
		}
		.favorite_posts{
			color:red;
		}
	</style>
@endsection
@section('content')
	<div class="header-bg">
		<div class="display-table  center-text">
			<h1 class="title display-table-cell"><b>Design</b></h1>
		</div>
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{asset('source/back/profile')}}/{{ $post->user->profileImage }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $post->user->name }}</b></a>
									<h6 class="date">{{ $post->created_at }}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><b>{{ $post->title }}</b></h3>

							<div class="post-image"><img src="{{asset('source/back/post')}}/{{ $post->postImage }}" alt="Blog Image" height=350 width=250></div>

							<p class="para">{!! $post->content !!}</p>

							<ul class="tags">
								@foreach($tags as $key => $tag)
									<li><a href="#">{{ $tag->name }}</a></li>
								@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
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

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-pinterest"></i></a></li>
							</ul>
						</div>


					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT BLOGGER</b></h4>
							<p>{{ $post->user->about }}</p>
						</div>

						<div class="sidebar-area subscribe-area">

							<h4 class="title"><b>SUBSCRIBE</b></h4>
							<div class="input-area">
								<form action="{{ route('user.subscriber') }}" method="POST">
									<input class="email-input" type="text" name="email" placeholder="Enter your email" style="padding-bottom: 28px;">
									<button class="submit-btn" type="submit" style="margin-bottom: 20px;"><i class="far fa-envelope"></i></button>
								</form>
							</div>
						</div><!-- subscribe-area -->

						<div class="tag-area">

							<h4 class="title"><b>Category CLOUD</b></h4>
							<ul>
								@foreach($catfilter as $key => $cate)
									<li><a href="#">{{ $cate->name }}</a></li>
								@endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">

				@foreach($randomPost as $key => $rp)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{asset('source/back/post')}}/{{ $rp->postImage }}" alt="Blog Image"></div>

							<div class="blog-info">
								<h4 class="title"><a href="{{route('user.single-blog', $rp->id)}}"><b>{{ $rp->title }}</b></a></h4>
								<ul class="post-footer">
									<li>
										@guest
											<a href="javascript:void(0);"onclick="toastr.success('To add favorite list. You have to login first.','Info',{
												closeButton: true,
												progressBar: true,
											})"><i class="fas fa-heart"></i>{{ $rp->favorite_to_users->count() }}</a>
										@else
											<a href="{{ route('post.favorite',$rp->id) }}" class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$rp->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="fas fa-heart"></i>{{ $rp->favorite_to_users->count() }}</a>
										@endguest
										
									</li>
									<li><a href="#"><i class="far fa-comment"></i>6</a></li>
									<li><a href="#"><i class="far fa-eye"></i>{{ $rp->view_count }}</a></li>
								</ul>
							</div><!-- blog-info -->

						</div><!-- single-post -->

					</div><!-- card -->
				</div><!-- col-md-6 col-sm-12 -->
				@endforeach

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						@guest
							<p>For post a new ccomment ,you need to login first <a href="{{route('home')}}">Login</a></p>
						@else
						<form method="post" action="{{route('comment.store',$post->id)}}">
							@csrf
							<div class="row">
								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
						@endguest
					</div><!-- comment-form -->

					<h4><b>COMMENTS({{ $post->comments()->count() }})</b></h4>
					@if ($post->comments()->count() > 0)
						@foreach($post->comments as $comment)
						<div class="commnets-area ">

							<div class="comment">

								<div class="post-info">

									<div class="left-area">
										<a class="avatar" href="#"><img src="{{asset('source/back/profile')}}/{{ $comment->user->profileImage }}" alt="Profile Image"></a>
									</div>

									<div class="middle-area">
										<a class="name" href="#"><b>{{$comment->user->name}}</b></a>
										<h6 class="date">{{$comment->created_at->diffForHumans()}}</h6>
									</div>

									{{-- <div class="right-area">
										<h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
									</div> --}}

								</div><!-- post-info -->

								<p>{{$comment->comment}}</p>

							</div>

						</div><!-- commnets-area -->
						@endforeach
					@else
						<div class="commnets-area ">

							<div class="comment">
								<p>No Comment Yet, Be the First</p>

							</div>

						</div><!-- commnets-area -->
					@endif
					
					

					{{-- <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a> --}}

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>
@endsection