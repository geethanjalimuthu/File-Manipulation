@extends ('layout')

@section ('title','Edit car details')

@section('content')

@if ($errors)
@foreach($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach
@endif


<form action="{{ route('cars-update', $car->id)}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
{{method_field('PUT')}}
	<div class="form-group">
		<label for="holdername">Holdername</label>
		<input type="text" class="form-control" name="holdername" value="{{ $car->customer_name }}">
	</div>
	<div class="form-group">
		<label for="carmodel">Carmodel</label>
		<input type="text" name="carmodel" value="{{ $car->carmodel or old('carmodel') }}" class="form-control">
	</div>
	<div class="form-group">
		<label for="year">Manufacturing year</label>
		<input type="text" class="form-control" name="year" value="{{ $car->manufacturing_year or old('year') }}">
	</div>
	<div class="form-group">
		<label for="feedback">Feedback</label>
		<textarea class="form-control" name="feedback">{{ $car->feedback or old('feedback')}}</textarea>
	</div>
	<div class="form-group">
		<label for="carimage">Car Image</label>
		<input type="file" name="carimage">
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-sm btn-success">Update</button>
	</div>
</form>
@endsection
