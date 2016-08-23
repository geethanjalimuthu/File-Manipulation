
@extends('layout')

@section('title','Profile')

@section('content')

<!-- test file file upload -->
			
			<h3>File Upload</h3>
	<form action="{{url('/uploads')}}" method="post" class="col-sm-5" enctype="multipart/form-data">
		{{csrf_field()}}
		<div>
			<label for="file">Upload File</label>
			<input type="file" name="file" id="file">
		</div>
		<input type="hidden" name="id" value="{{auth()->user()->id}}">
		<input type="hidden" name="folder" value="{{Request::segment(2)}}">
		<div class="form-group" style="margin-top: 10px">
			<button type="submit"  name="submit" class="btn btn-success">Upload</button>
		</div>
	</form>

<!-- End of test file -->
@endsection

