@extends('layout')
	
@section('title','Login')

@section('content')

	<form action="{{ url('login') }}" method="post">
	{{csrf_field()}}
		<div class="form-group">
			<label name="email">Email</label>
			<input type="text" id="email" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label name="password">Password</label>
			<input type="password" id="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">
				<span>Login</span>
			</button>
		</div>
		<div>Please<a href="/register">Register</a></div>
	</form>
@endsection
