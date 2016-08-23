@extends('layout')

@section('title','Register')

@section('content')
@include('partial.error')
<form action="{{route('user-postregister')}}" method="post">
{{ csrf_field() }}
	<div class="col-sm-5 col-sm-offset">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" id="name"  name="name" class="form-control">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" id="email"  name="email" class="form-control">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" id="password"  name="password" class="form-control">
		</div>
		<div class="form-group">
			<button type="submit"  name="submit" class="btn btn-success">Register</button>
		</div>
		<div>
			<p>Already registered <a href="{{url('login')}}">Please login</a></p>
		</div>
	</div>
</form>
@endsection