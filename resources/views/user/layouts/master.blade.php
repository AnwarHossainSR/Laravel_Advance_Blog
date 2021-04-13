<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Blog Site @yield('title')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css" integrity="sha512-shT5e46zNSD6lt4dlJHb+7LoUko9QZXTGlmWWx0qjI9UhQrElRb+Q5DM7SVte9G9ZNmovz2qIaV7IWv0xQkBkw==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<!-- Toster CSS -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


	<!-- Stylesheets -->

	<link href="{{asset('user/common-css/bootstrap.css')}}" rel="stylesheet">

	<link href="{{asset('user/common-css/swiper.css')}}" rel="stylesheet">

	<link href="{{asset('user/common-css/ionicons.css')}}" rel="stylesheet">
	@yield('customCSS')
</head>
<body >

	<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="{{ route('homepage') }}" class="logo"><img src="{{asset('user/images/logo.png')}}" alt="Logo Image"></a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{ route('homepage') }}">Home</a></li>
				<li><a href="#">Categories</a></li>
				@if (Route::has('login'))
					@auth
						@if (Auth::user()->type == 'Superadmin')
								<li><a href="{{ url('dashboard/superadmin') }}">Dashboard</a></li>
							@elseif(Auth::user()->type == 'Admin')
								<li><a href="{{ url('dashboard/admin') }}">Dashboard</a></li>
							@elseif(Auth::user()->type == 'Author')
								<li><a href="{{ url('dashboard/author') }}">Dashboard</a></li>
							@else
								<li><a href="{{ url('dashboard/user') }}">Dashboard</a></li>
							@endif
						@else
							<li><a href="{{ route('login') }}">Login</a></li>

							@if (Route::has('register'))
								<li><a href="{{ route('register') }}">Registration</a></li>
							@endif
					@endauth
                @endif
			</ul><!-- main-menu -->

			<div class="src-area">
				<form method="GET" action="{{ route('search.post') }}">
					<button class="src-btn" type="submit"><i class="fas fa-search"></i></button>
					<input class="src-input" type="text" name="query" placeholder="Type of search" style="margin-top: 20px;padding-top: -10px;padding-bottom: 20px;">
				</form>
			</div>

		</div><!-- conatiner -->
	</header>

	@yield('content');

	<footer>

		<div class="container">
			<div class="row">

				<div class="col-lg-3 col-md-6">
					<div class="footer-section">

						<a class="logo" href="{{ route('homepage') }}"><img src="{{asset('user/images/logo.png')}}" alt="Logo Image"></a>
						<p class="copyright">Bona @ 2021. All rights reserved.</p>
						<p class="copyright">Designed by Bona Teams</p>
						<ul class="icons">
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-instagram-square"></i></a></li>
							<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
							<li><a href="#"><i class="fab fa-pinterest"></i></a></li>
						</ul>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-3 col-md-6">
						<div class="footer-section">
						<h4 class="title"><b>CATAGORIES</b></h4>
						<ul>
							@foreach($catfilter as $key => $cate)
								<li><a href="{{ route('user.category-post',$cate->id) }}">{{ $cate->name }}</a></li>
							@endforeach
						</ul>
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->
				<div class="col-lg-3 col-md-6">
					<h4>AUTHORS</h4>
					<ul>
						@foreach($authors as $key => $author)
						<li style="list-style: disclosure-closed;
						display: block;
						text-align: left; text-align:left;"><a href="{{route('user.single-author', $author->id)}}">{{$author->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4>
						<div class="input-area">
							<form action="{{ route('user.subscriber') }}" method="POST">
								@csrf
								<input class="email-input" type="text" name="email" placeholder="Enter your email" style="padding-bottom: 28px;">
								<button class="submit-btn" type="submit" style="margin-bottom: 20px;"><i class="far fa-envelope"></i></i></button>
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
<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

	<script>
		@if($errors->any())
   
		  @foreach ($errors->all() as $error)
  
				toastr.error('{{$error}}','Error.!',{
				
				closeButton:true,
				progressBar:true,
				
				}); //It requires optional parameter value
  
			@endforeach
  
		@endif
	</script>

</body>
</html>


