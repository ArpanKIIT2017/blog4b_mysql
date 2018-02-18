@extends('Layouts.app_custom')

@section('content_custom')

<div class="jumbotron">

    <form action="{{action('PostsController@store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
       
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="title" name="title" class="form-control"/>
            </div>

            <div class="form-group">
                <label>Body</label>
                <textarea id="article-ckeditor" name="body" class="form-control"/></textarea>
            </div>
           
            <div class="form-group">
                <label>Cover Photo : </label><br>
                <input type="file" name="cover_pic">
            </div>
            <div class="form-group" style="text-align:center">
                <input type="submit" class="btn btn-success btn-lg" id="submit" value="Post It"/>
            </div>
            
            
       
    </form>
</div>


@endsection