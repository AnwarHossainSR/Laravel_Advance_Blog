@extends('superadmin.master')
@section('title')
    Super Admin || Send Email TO User
@endsection

@section('content')
<div class="container">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('source/back/profile') }}/{{ $user->profileImage }}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $user->name }}</h4>
                      <p class="text-dark mb-1">Total Post : {{ $user->posts->count() }}</p>
                      <p class="text-muted font-size-sm">
                            @if ($user->active == 1)
                                <li class="text-success text-bold">Active</li>
                            @endif
                        </p>
                      <a href="" class="btn btn-outline-primary">Message</a>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                  @include('superadmin.include.alert')
                <div class="card-body">
                    <!-- form start -->
                    <form action="{{ route('email.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <input class="form-control" type="text" name="email" value="{{ $user->email }}" hidden>
                            <input class="form-control" type="text" name="name" value="{{ $user->name }}" hidden>
                          <label>Subject</label>
                          <input class="form-control" type="text" name="subject" placeholder="Write your subject">
                          <label>Message</label>
                          <textarea type="text" class="form-control" name="message" placeholder="Write your message" rows="4"></textarea>
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