@extends('layouts\app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Welcome to Blog4B</h1>
            <div class="card card-default">
                <div class="card-header">Blog4B Guest Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    Hey you are at the right place.
                    <br>
                    <br>
                    <div style="text-align:center">
                    <a href="{{URL::to('posts')}}" class="btn btn-outline-info btn-lg">View our public posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
