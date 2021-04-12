@extends('author.master')

@section('title')
    Author || All Trashed Post
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Show the deleted post</h3>
  </div>
   

  <div class="text-right">
    <a href="{{route('AuthorPostController.add_post')}}" ><button class="btn btn-primary waves-effect">Add New Post</button></a> 
 </div> 


  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Post ID</th>
        <th>Post Title</th>
        {{-- <th>Excerpt</th> --}}
        <th>Category</th>
       <th>Status</th>
        <th>Post Added</th>
        {{-- <th>Post Updated</th> --}}
       <th>Image</th>
       <th>Total Views</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>

         {{--@for($i=0; $i< count($list);$i++)--}}
    
    @foreach ($post_info as $value) 
    <tr>
       <td>{{$value->id}}</td>
       <td>{{$value->title}}</td>
       {{-- <td>{{$value->excerpt}}</td> --}}
       <td> 
          @foreach ($value->categories as $item)
           
          {{$item->name}}
          
          @endforeach
      </td>
      <td>
        @if ($value->status=='Unpublish')
        
        <span class="badge bg-red">Pending</span>
            
        @else
            
        <span class="badge bg-green">Approved</span> 

        @endif
      </td>

      <td>{{$value->created_at}}</td>
      {{-- <td>{{$value->updated_at}}</td> --}}
      
      {{-- Image --}}
      <td>
        <div style="max-width:70px; max-height:70px; overflow:hidden">
         <img src="{{asset('/storage/post_img')}}/{{$value->postImage}}" class="img-fluid" alt="">
         
        {{--{{asset('/storage/author_img')}}/{{$author['profileImage']}}--}} 

        </div>
     
     </td>

     <td>{{$value->view_count}}</td>

     <td class="text-centre">


      <a href="{{ route('AuthorPostController.restore_recyclebin_post', $value->id)}}" class='btn btn-info' data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-recycle"></i></a>

      <button class="btn btn-danger waves-effect" type="button" onclick="deleteFunc({{$value->id}})">
        
        <i class="fas fa-trash"></i>
        
      </button>

      <form method="post" id="delete-form-{{$value->id}}" action="{{route('AuthorPostController.post_permanent_delete',$value->id)}}" 
      
      style="display: none;">
      
      @csrf

      @method('DELETE')

      </form>
      
    </td>
    
    </tr>
    {{-- @endfor--}}
    @endforeach

      </tbody>
     
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection

@section('script')


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> 

{{-- Sweet Alert --}}


<script type="text/javascript" >

  function deleteFunc(id)
  {
      
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
  })
  
  swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "Your post will deleted permanently!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
  }).then((result) => {
      if (result.isConfirmed) {
          event.preventDefault();
          document.getElementById('delete-form-'+id).submit();
      } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
      ) {
          swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your post is safe :)',
              'error'
          )
      }
  })
  
  }
  
  </script>
@endsection



