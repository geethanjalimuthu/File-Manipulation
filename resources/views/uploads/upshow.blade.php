@extends('layout')

@section('title','Newfolder')

@section('content')
	<h3>New Folder</h3>
	<form action="{{url('/folder')}}" method="post" class="col-sm-5">
		{{csrf_field()}}
		<div>
			<label for="folder">Folder name</label>
			<input type="text" name="folder" id="folder">
		</div>
		<div class="form-group" style="margin-top: 10px">
			<button type="submit"  name="submit" class="btn btn-success">Add Folder</button>
		</div>
	</form>
@endsection