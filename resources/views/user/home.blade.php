<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>TITLE</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css" integrity="sha512-shT5e46zNSD6lt4dlJHb+7LoUko9QZXTGlmWWx0qjI9UhQrElRb+Q5DM7SVte9G9ZNmovz2qIaV7IWv0xQkBkw==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />


	<!-- Stylesheets -->

	<link href="{{asset('user/common-css/bootstrap.css')}}" rel="stylesheet">

	<link href="{{asset('user/common-css/swiper.css')}}" rel="stylesheet">

	<link href="{{asset('user/common-css/ionicons.css')}}" rel="stylesheet">


	<link href="{{asset('user/front-page-category/css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('user/front-page-category/css/responsive.css')}}" rel="stylesheet">

</head>
<body >

	<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="#" class="logo"><img src="{{asset('user/images/logo.png')}}" alt="Logo Image"></a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="#">Home</a></li>
				<li><a href="#">Categories</a></li>
				<li><a href="#">Features</a></li>
			</ul><!-- main-menu -->

			<div class="src-area">
				<form>
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" type="text" placeholder="Type of search">
				</form>
			</div>

		</div><!-- conatiner -->
	</header>

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


	<footer>

		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<a class="logo" href="#"><img src="{{asset('user/images/logo.png')}}" alt="Logo Image"></a>
						<p class="copyright">Bona @ 2017. All rights reserved.</p>
						<p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a>.Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a></p>
						<ul class="icons">
							<li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
						</ul>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
						<div class="footer-section">
						<h4 class="title"><b>CATAGORIES</b></h4>
						<ul>
							<li><a href="#">BEAUTY</a></li>
							<li><a href="#">HEALTH</a></li>
							<li><a href="#">MUSIC</a></li>
						</ul>
						<ul>
							<li><a href="#">SPORT</a></li>
							<li><a href="#">DESIGN</a></li>
							<li><a href="#">TRAVEL</a></li>
						</ul>
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4>
						<div class="input-area">
							<form>
								<input class="email-input" type="text" placeholder="Enter your email">
								<button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
							</form>
						</div>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

			</div><!-- row -->
		</div><!-- container -->
	</footer>


	<!-- SCIPTS -->

	<script src="{{asset('user/common-js/jquery-3.1.1.min.js')}}"></script>

	<script src="{{asset('user/common-js/tether.min.js')}}"></script>

	<script src="{{asset('user/common-js/bootstrap.js')}}"></script>

	<script src="{{asset('user/common-js/swiper.js')}}"></script>

	<script src="{{asset('user/common-js/scripts.js')}}"></script>

</body>
</html>