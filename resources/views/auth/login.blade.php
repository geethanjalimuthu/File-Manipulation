@extends('layout')

@section('title','Login')

@section('content')
<div class="col-sm-5">
	<form action="{{url('login')}}" method="post">
	<div class="form-group ">
	   {{csrf_field()}}
		<label for="email">Email</label>
		<input type="text" class="form-control" id="email" name="email">
	</div>
	<div class="form-group">
		<label for="Password">Password</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>
	<div class="form-group">
		<button type="submit" name="submit" class="btn btn-success">Login</button>		
	</div>
	<div>Please<a href="{{url('/register')}}"> Register</a></div>
	</form>
</div>

@endsection