@extends('user.layouts.master')
@section('title', 'Home')
@section('customCSS')
	<link href="{{asset('user/front-page-category/css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('user/front-page-category/css/responsive.css')}}" rel="stylesheet">
@endsection
@section('content')
	<div class="main-slider">
		<div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
			data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
			data-swiper-breakpoints="true" data-swiper-loop="true" >
			<div class="swiper-wrapper">

			     @foreach($categories as $key => $cate)
					<div class="swiper-slide">
						<a class="slider-category" href="#">
							<div class="blog-image"><img src="{{asset('source/back/category')}}/{{ $cate->image }}" alt="Category Image" width=250 height=250></div>

							<div class="category">
								<div class="display-table center-text">
									<div class="display-table-cell">
										<h3><b>{{ $cate->name }}</b></h3>
									</div>
								</div>
							</div>

						</a>
					</div><!-- swiper-slide -->
				@endforeach
			</div><!-- swiper-wrapper -->

		</div><!-- swiper-container -->

	</div><!-- slider -->

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
										<li><a href="#"><i class="far fa-heart"></i>57</a></li>
										<li><a href="#"><i class="far fa-comment"></i>6</a></li>
										<li><a href="#"><i class="far fa-share-square"></i>138</a></li>
									</ul>

								</div><!-- blog-info -->
							</div><!-- single-post -->
						</div><!-- card -->
					</div><!-- col-lg-4 col-md-6 -->
					@endforeach
				
				
				
			</div><!-- row -->

			{{-- <a class="load-more-btn" href="#"><b>LOAD MORE</b></a> --}}

		</div><!-- container -->
	</section><!-- section -->

@endsection