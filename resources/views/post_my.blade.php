@extends('Layouts.app_custom')

@section('content_custom')

@if(count($posts)>0)

    @foreach($posts as $post)
        
            <div class="POST">
                <div style="display:inline-block">
                         <img src="{{ asset("storage/cover_pics/$post->cover_pic") }}" width="100px" height="100px" class="rounded-circle" alt="No image found" >
     
                </div>    
                <div style="display:inline-block">
                         <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                </div>
     
                 <small>{{$post->author}}</small>
                 <small>{{$post->created_at}}</small>
        
    @endforeach
    

@else
    <p>No posts Found</p>
@endif

@endsection