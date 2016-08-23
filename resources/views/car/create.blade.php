@extends('layout')

@section('title','Add Car')

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
	
	<form action="{{ route('cars-post') }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="col-sm-6">
				<div class="form-group">
					<label for="holdername">Holder Name</label>
					<input type="text" class="form-control" id="holdername" value="{{ old ('holdername') }}" name="holdername">
				</div>
				<div class="form-group">
					<label for="carmodel">Car Model</label>
					<input type="text" class="form-control" id="carmodel" value="{{ old('carmodel') }}" name="carmodel">
				</div>
				<div class="form-group">
					<label for="year">Manufacturing Year</label>
					<input type="text" class="form-control" id="year" value="{{ old('year') }}" name="year">
				</div>
				<div class="form-group">
					<label for="feedback">Feedback</label>
					<textarea id="feedback" name="feedback" class="form-control">{{ old('feedback') }}</textarea>
				</div>
				<div class="form-group">
					<label for="carimage">Car Image</label>
					<input type="file" id="carimage" name="carimage">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">
						<span>Add</span>
					</button>
				</div>
		</div>
	</form>

@endsection