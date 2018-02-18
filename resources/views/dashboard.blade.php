@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Welcome to Blog4B</h1>
            <div class="card card-default">
                <div class="card-header">
                    Dashboard
                   
                    
                   
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <h4 style="display:inline">Your Posts</h4>
                    <a href="{{URL::to('posts')}}" class="btn btn-primary float-right btn-sm">Post Board</a> 
                    <hr>
                    
                    @if(count($posts)>0)

                        @foreach($posts as $post)

                            <div class="row">
                                <div class=col>
                                    <img src="{{ asset("storage/cover_pics/$post->cover_pic") }}" width="100px" height="100px" class="rounded-circle" alt="No image found" >
                                </div>
                                <div class=col>
                                    <a href="posts/{{$post->id}}">{{$post->title}}</a>
                                </div>
                                <div class=col>
                                        {{$post->countLikes()}} like(s)<br>
                                        {{$post->countComments()}} comment(s)
                                </div>
                            </div>


                        @endforeach

                    @else
                            No posts found<br>
                            <div style="text-align:center">
                                <a href="{{URL::to('posts/create')}}" class="btn btn-outline-info">Create a new Post</a>
                            </div>
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
