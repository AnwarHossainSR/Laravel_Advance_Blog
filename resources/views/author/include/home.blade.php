@extends('author.author')

@section('title')
    Author || Dashboard
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            {{ $data->id}}
            {{ $data->type}}
            {{ $data->name}}
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



@endsection
