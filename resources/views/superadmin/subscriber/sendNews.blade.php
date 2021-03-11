@extends('superadmin.master')
@section('title')
    Super Admin || Send News By Email
@endsection

@section('content')
<div class="container">
    <div class="main-body">
          <div class="row gutters-sm">
            
            <div class="col-md-12">
              <div class="card mb-3">
                  @include('superadmin.include.alert')
                <div class="card-body">
                    <!-- form start -->
                    <form action="{{ route('subscriber.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label>Subject</label>
                          <input class="form-control" type="text" name="subject" placeholder="Write your subject">
                          <label>Message</label>
                          <textarea type="text" class="form-control" name="message" placeholder="Write your message" rows="5"></textarea>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div> 
@endsection

@section('style')
  <style>
    .main-body {
        padding: 15px;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }

  </style>
@endsection