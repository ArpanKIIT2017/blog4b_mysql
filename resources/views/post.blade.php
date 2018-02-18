@extends('Layouts.app_custom')

<div class="tab-pane active container" id="posts">
@section('content_custom')



@if(count($posts)>0)

    @foreach($posts as $post)
        <div class="jumbotron">
           <div style="display:inline-block">
                    <img src="{{ asset("storage/cover_pics/$post->cover_pic") }}" width="100px" height="100px" class="rounded-circle" alt="No image found" >

           </div>    
           <div style="display:inline-block">
                    <h3><a href="posts/{{$post->id}}">{{$post->title}}</a><br>
                    <small>{{$post->countLikes()}} people liked this post.</small>
                    </h3>
           </div>
           <hr>
            <small>{{$post->author}}</small>
            <small>{{$post->created_at}}</small>
        </div>
    @endforeach
    

@else
    <p>No posts Found</p>
@endif






@endsection

</div>