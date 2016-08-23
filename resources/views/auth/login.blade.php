@extends('layout')

@section('title','Login')

@section('content')
<form action="{{url('login')}}" method="post">
	<div class="form-group">
	   {{csrf_field()}}
		<label for="email">Email</label>
		<input type="text" class="form-control" id="email" name="email">
	</div>
	<div class="form-group">
		<label for="Password">Password</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>
	<div class="form-group">
		<button class="btn btn-success">Login</button>		
	</div>
	<div>Please<a href="/register"> Register</a></div>
</form>
@endsection