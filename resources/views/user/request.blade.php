@extends('user.layouts.dashboard-master')

@section('title')
    User || Request
@endsection
@push('css')
  <link href="{{ asset('source/back') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
  <script src="https://cdn.tiny.cloud/1/qbghu4tnq16uzuojk6all9lci25ogff0uz85m2o6933y2ryk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Request Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Request</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <form action="{{ route('user.request.post') }}" method="POST">
                @csrf
              <!--row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                    @include('superadmin.include.alert')
                      <!-- /.card-header -->
                      <!-- form start -->
                      
                        <div class="card-body">
                          <div class="md-form">
                            <label >Request Message</label>
                            <textarea id="tinymce" name="message" class="md-textarea form-control" rows="3"></textarea>
                          </div><br>
                          <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Send</button>
                          </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
              <!--/row-->
            </form>
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
      </section>

@endsection

@section('script')
<script src="{{ asset('source/back') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script>

    tinymce.init({
      selector: 'textarea#tinymce',
      height: 500,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
    
        </script>
@endsection

