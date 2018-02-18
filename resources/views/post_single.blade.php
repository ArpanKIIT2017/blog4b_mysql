
@extends('Layouts.app_custom')

@section('content_custom')


       <div class="jumbotron">
           <p style="text-align:right">
            <a href="{{URL::to('posts')}}" class="btn btn-light">Back to All Posts</a> 
           </p>
            <hr>          
            <h3>{{$post->title}}</h3>
            <small>Author : {{$post->author}}</small>
            <hr>
            <div style="display:inline-block">
                    {!! $post->body !!}
            </div>
           
            <button type="button" class="btn btn-primary float-right" data-toggle="collapse" data-target="#image">View Image</button>
            <br><br>
            <div id="image" class="collapse">
                <br>
                <img src="{{ asset("storage/cover_pics/$post->cover_pic") }}" width="500px" height="500px" class="rounded" alt="No image found">
            </div>
            <br>
            
            <hr>
            <small>Created at {{$post->created_at}}</small>
            <hr>
            <div style="text-align:left">
            @if(!Auth::guest())

            <a href="{{$post->id}}/addLike" class="btn btn-outline-info">
                    Like
                    <span class="badge badge-light">{{$post->countLikes()}}</span>
            </a>


            <button type="button" class="btn btn-outline-info" data-toggle="collapse" data-target="#comments">Comments
                <span class="badge badge-light">{{$post->countComments()}}</span>
            </button>
            
            



                @if(Auth::user()->id == $post->user_id)
                    <a class="btn btn-primary" href="{{$post->id}}/edit" >Edit Post</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delwarn">Delete</button>  
                @endif


                

            @endif
            </div>
        </div>

        <div id="comments" class="collapse jumbotron">
            <br>
            <form method="POST" action="{{route('comments.store')}}">
                @csrf
                <div class="form-group">
                    <textarea name="comment_body" class="form-control" placeholder="Your Comment Here..."/></textarea>
                </div>
                
                <input type="hidden" name='post_id' value="{{$post->id}}">
                <input type="submit" class="btn btn-success" value="Post Comment">
                
            </form>      
            
            <!--
                //logic to display all comments to a post
            -->
            <hr>
            @if(count($comments)>0)
                @foreach($comments as $comment)
                    <div>
                    <h5>{{$comment->username}}
                        <small>{{$comment->created_at}}</small>
                    </h5>
                    
                    <p>
                        {{$comment->comment_body}}
                    </p>
                    @if(!Auth::guest())
                        @if((Auth::user()->id==$post->user_id)||(Auth::user()->id==$comment->user_id))
                        <form method="POST" action="{{ route('comments.destroy',$comment->id) }}" style="display:inline-block">
                            @method('delete')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                        @endif
                    @endif

                    <hr>
                    
                @endforeach
            @endif

            
        </div>



        <div class="modal fade" id="delwarn">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Warning!!</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <strong>Are you sure that you want to delete this post?</strong><br>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form method="POST" action="{{ route('posts.destroy',$post->id) }}" style="display:inline-block">
                            @method('delete')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </div>
                   
                    
                  </div>
              
   





@endsection