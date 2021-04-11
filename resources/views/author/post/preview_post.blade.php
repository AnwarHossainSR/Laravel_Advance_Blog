@extends('author.master')

@section('title')
    Author || Post Preview
@endsection

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
              <div class="card" >
                 <div class="card-header" >
                     <div class="d-flex justify-content-between align-items-center">
                         <h3 class="card-title" > Preview Post</h3>
                         <a href="{{route('AuthorPostController.add_post')}}" ><button class="btn btn-primary waves-effect">Add New Post</button></a> 
                     </div>
                     
                </div> 
                 <div class="card-body p-0">

                    <table class="table table-striped">
                         <tbody>
                             <tr>
                                 <th style="width: 100px" >Post Title</th>
                                 <td>{{$post_info->title}}</td>
                             </tr>
                             <tr>
                                <th style="width: 100px" >Excerpt</th>
                                <td>{{$post_info->excerpt}}</td>
                            </tr>
                            <tr>
                                <th style="width: 100px" >Category</th>
                                <td>
                                
                                        @foreach ($post_info->categories as $item)
                                         
                                        {{$item->name}}
                                        
                                        @endforeach
                                   
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 100px" >Status</th>
                                {{-- <td>{{$post_info->status}}</td> --}}

                                <td>
                                    @if ($post_info->is_approve==0)
        
                                    <span class="badge bg-red">Pending</span>
                                        
                                    @else
                                        
                                    <span class="badge bg-green">Approved</span> 
                            
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 100px" >Author</th>
                                <td>{{$id= Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <th style="width: 100px" >Post Added</th>
                                <td>{{$post_info->created_at}}</td>
                            </tr>
                            <tr>
                                <th style="width: 100px" >Post Updated</th>
                                <td>{{$post_info->updated_at}}</td>
                            </tr>

                            <tr>
                                <th style="width: 100px" >Total View</th>
                                <td>{{$post_info->view_count}}</td>
                            </tr>

                            <tr>
                                <th style="width: 100px" >Image</th>
                                <td>
                                    
                                    <div style="max-width:70px; max-height:70px; overflow:hidden">
                   
                                        <img src="{{asset('/source/back/post')}}/{{$post_info->postImage}}" class="img-fluid" alt="">
                         
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th style="width: 100px" >Description</th>
                                <td>{!!$post_info->content!!}</td>
                            </tr>

                         </tbody>
                    </table>

                 </div>

              </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


@endsection

@section('script')

 
@endsection



