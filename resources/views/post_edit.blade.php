@extends('Layouts.app_custom')


@section('content_custom')

<div class="POST">

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}
           {{ method_field('PUT') }}
           <div class="form-group">
                <label>Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{$post->title}}"/>
            </div>

            <div class="form-group">
                <label>Body</label>
                <textarea id="article-ckeditor" name="body" class="form-control" value=""/>{{$post->body}}</textarea>
            </div>
           
            <div class="form-group">
                <label>Cover Photo : (Select only if you want to change)</label><br>
                <input type="file" name="cover_pic">
            </div>
            <div class="form-group" style="text-align:center">
                <input type="submit" class="btn btn-success btn-lg" id="submit" value="Submit"/>
            </div>
    </form>
</div>


@endsection