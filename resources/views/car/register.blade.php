@extends('layout')

@section('title','Register')

@section('content')
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	<form action="{{route('register-store')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="col-sm-6">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" id="image" name="image">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">
						<span>Register</span>
					</button>
				</div>
				<div><a href="{{route('login')}}">login</a></div>
		</div>
	</form>

@endsection