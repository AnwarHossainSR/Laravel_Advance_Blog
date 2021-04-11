@extends('user.layouts.dashboard-master')

@section('title')
    User || Dashboard
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        
        <div class="row clearfix">
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-cyan">
                    <div class="inner">
                      {{ $posts->count() }}
                      <p>Total Favorite Posts</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-heart"></i>
                    </div>
                </div> 
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-orange">
                    <div class="inner">
                      
                      {{ $comments->count() }}
                      <p>Total Comments</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-comment"></i>
                    </div>
                </div> 
            </div>
            
            
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@endsection

