@extends('author.master')

@section('title')
    Author || Dashboard
@endsection


@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>{{$greetings}} ! <a href="{{route('AuthorProfileController.view_profile')}}"> {{ $data->name}}</a></h4>
          <h6> {{$clock_time}}</h6>
          <h6> {{$today_date}}</h6>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


<div class="content">
    <div class="container-fluid">

      
        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success ">
                  <div class="inner">
                    <h4>{{$total_post}}</h4>
    
                    <p>Total Post</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-pen-nib"></i>
                  </div>
                  
                </div>
              </div>


              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-yellow ">
                  <div class="inner">
                    <h4>{{$total_view}}</h4>
    
                    <p>Total View</p>
                  </div>
                  <div class="icon">
                    <i class="far fa-eye"></i>
                  </div>
                  
                </div>
              </div>


              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-orange ">
                  <div class="inner">
                    <h4>{{$total_pending_post}} </h4>
    
                    <p>Post Pending</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-sync"></i>
                  </div>
                  
                </div>
              </div>


              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-teal ">
                  <div class="inner">
                    <h4>150</h4>
    
                    <p>Total Post</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-pen-nib"></i>
                  </div>
                  
                </div>
              </div>

              <div class="row" >

                <div class="col-12">
                    <div class="card card-gray">
                      <div class="card-header">
                        <h3 class="card-title"> <b>Most Popular Posts By Me</b></h3>
        
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Image</th>
                              <th>Category</th>
                              <th>Views</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            

                              @foreach ($pop_post_info as $info)
                              <tr>
                              <td>{{$info->id}}</td>
                              <td>{{$info->title}}</td>
                              <td>
                                <div style="max-width:70px; max-height:70px">
                                        
                                  <img src="{{asset('/source/back/post')}}/{{$info->postImage}}" class="img-fluid" alt="">
                            
                   
                                 </div>

                              </td>
                              <td>
                                @foreach ($info->categories as $item)
           
                                {{$item->name}}
                                
                                @endforeach
                              </td>
                              <td>{{$info->view_count}}</td>
                              <td>
                                <a href="{{route('AuthorPostController.preview',$info->id)}}" class='btn btn' data-toggle="tooltip" data-placement="top" title="View Details">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                              </td> 

                              </tr>
                              @endforeach

                            
                            
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

              </div>

        </div><!-- /.row -->  
    </div><!-- /.container-fluid -->
</div>



@endsection


@section('style')




@endsection