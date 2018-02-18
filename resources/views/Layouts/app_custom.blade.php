@extends('Layouts.app')

@section('content')
<link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
	
	<div>
		<hr>
		
			<ul class="nav justify-content-center">
				<li class="nav-item btn btn-light"><a class="nav-link"  href="{{URL::to('/')}}" />Dashboard</a></li>
				<li class="nav-item btn btn-light"><a class="nav-link"  href="{{URL::to('/myposts')}}" />My Posts</a></li>
				<li class="nav-item btn btn-light"><a class="nav-link"  href="{{URL::to('posts')}}" />All Posts</a></li>
				<li class="nav-item btn btn-light"><a class="nav-link"  href="{{URL::to('posts/create')}}" />Create New</a></li>
				
			</ul>
		
		<hr>
	</div>
		
	
	<div class="MAINcontent">
		<div class="tab-content">
			@include('messages')
			@yield('content_custom')
		</div>
	</div>
@endsection