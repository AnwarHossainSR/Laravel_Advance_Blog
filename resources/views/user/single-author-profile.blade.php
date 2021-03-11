@extends('user.layouts.master')
@section('title', 'Author Profile')
@section('customCSS')
	<link href="{{asset('user/front-page-category/css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('user/front-page-category/css/responsive.css')}}" rel="stylesheet">
@endsection
@section('content')
	<section class="blog-area section">
		<div class="container">
            <div class="row">
                <div class="col-md-12">
      
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <a href="#" class="avater"><img style="max-width: 200px; border-radius:50%" class="" src="{{asset('source/back/profile')}}/{{ $author->profileImage }}" alt="User profile picture"></a>
                        </div>
      
                        <h3 class="profile-username text-center">{{ $author->name }}</h3>
        
                        <p class="text-muted text-center">{{ $author->email }}</p>
        
                        <ul class="list-group list-group-unbordered mb-3">
                            {{-- <li class="list-group-item">
                            <b>Total Post</b> <a class="float-right">{{ count($author->posts) }}</a>
                            </li> --}}
                            <li class="list-group-item">
                            <b>Total Comment</b> <a class="float-right">543</a>
                            </li>
                            {{-- <li class="list-group-item">
                            <b>Joined</b> <a class="float-right">{{ Auth::user()->created_at->toFormattedDateString() }}</a>
                            </li> --}}
                        </ul>
      
                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
            </div>
			<div class="row">
				<div class="col-lg-6 col-md-12">
					@foreach($posts as $key => $post)
					<div class="col-md-12">
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
				</div>
			</div><!-- row -->

			{{-- <a class="load-more-btn" href="#"><b>LOAD MORE</b></a> --}}

		</div><!-- container -->
	</section><!-- section -->

@endsection