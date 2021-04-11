@extends('author.master')

@section('title')
    Author || Profile
@endsection

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('author.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Author Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



<!-- Main content -->


<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
               <!-- <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">-->
                <img class="profile-user-img img-fluid img-circle" src="{{asset('source/back/profile')}}/{{$author['profileImage']}}" alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{$author['name']}}</h3>

              <p class="text-muted text-center">{{$author['type']}}</p>


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong> <i class="fas fa-envelope"> </i> Contract</strong>

              <p class="text-muted">
                {{$author['email']}}
              </p>

              <hr>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
               
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile Settings</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">

                <!-- /.tab-pane -->

                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">

                  <form class="form-horizontal" action="{{route('AuthorProfileController.save_profile')}}" method="POST" enctype="multipart/form-data">
                   
                      @csrf

                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$author['name']}}" id="inputName" placeholder="Name">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span> 
                         @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail" name="email" value="{{$author['email']}}" placeholder="Email">
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span> 
                         @endif
                      </div>
                    </div>


                   <div class="form-group row">
                    <div class="ml-2 col-sm-6">
                      <div id="msg"></div>
                    
                        <input type="file" value="{{$author['profileImage']}}" name="image" class="file" accept="image/*">
                        <div class="input-group my-3">
                          <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                          <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Browse...</button>
                          </div>
                        </div>
                      
                    </div>
                    <div class="ml-2 col-sm-6">
                      <img src="{{asset('source/back/profile')}}/{{$author->profileImage}}" id="preview" class="img-thumbnail">
                    </div>

                   </div>

 


                      <div class="form-group">
                        <label>About You</label>
                        <textarea name="Info" class="form-control" rows="3" placeholder="Short info on your biography,education,research etc. ..." style="margin-top: 0px; margin-bottom: 0px; height: 87px;">
                          {{$author->about}} 
                        </textarea>
                      </div>  
                   
     
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
<!-- /.content -->
  @endsection

  @section('style')
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
  
<style >
  
  .file {
    visibility: hidden;
    position: absolute;
  }

</style>

      
  @endsection


  @section('script')

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


      <script>
      $(document).on("click", ".browse", function() {
  var file = $(this).parents().find(".file");
  file.trigger("click");
});
$('input[type="file"]').change(function(e) {
  var fileName = e.target.files[0].name;
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});  
      </script>
  @endsection