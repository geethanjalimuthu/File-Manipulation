@extends('layout')

@section('title','Car List')

@section('content')

	<h2>
		Car Listing
		<a href="{{ route('cars-create') }}" class="btn btn-success btn-xs">
			Add 
		</a>
	</h2>
	@if (count($car) > 0) 
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Holder Name</th>
						<th>Car Model</th>
						<th>Manufacturing Year</th>
						<th>Feedback</th>
						<th>Car Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($car as $cars)
					<tr>
						
						<td>{{ $cars->customer_name }}</td>
						<td>{{ $cars->carmodel }}</td>
						<td>{{ $cars->manufacturing_year }}</td>
						<td>{{ $cars->feedback }}</td>
						<td><img src="\image\{{ $cars->car_image }}" width="75px" height="80px"/></td>
						<td><a href="{{ route('cars-edit',$cars->id) }}">Edit</a><br/>
							Delete</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<p class="alert alert-info">
			Nothing to list
		</p>
	@endif

@endsection