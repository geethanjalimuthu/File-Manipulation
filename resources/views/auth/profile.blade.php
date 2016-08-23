@extends('layout')

@section('title','Profile')

@section('content')
<h3>File Listing</h3>
<div class="pull-right">
	<div class="pull-left"><a href="/uploads"><i class="fa fa-file fa-2x" aria-hidden="true">Upload</i></a></div>
	<div class="pull-right"><a href="/folder"><i class="fa fa-folder fa-2x" aria-hidden="true">Create Folder</i></a></div>
</div>
@if(isset($directory))
	<div>

		@foreach($directory as $dir)

		<i class="fa fa-folder fa-lg" aria-hidden="true">{{$dir['dir']}}</i>  <a href="/uploads/{{$dir['dir']}}">upload</a>   <a href="/delete/{{auth()->user()->id}}/{{$dir['dir']}}">delete</a><br/> 
		
		<?php $v = count($dir['files']); ?>
		<?php  
		$i=0; ?>
		@for($i;$i<$v;$i++)
			<?php $file =$dir['files'][$i];
			$value = explode('/',$file);
			$end = end($value);
			 ?>
				<i class="fa fa-file fa-sm" aria-hidden="true">{{$dir['files'][$i]}}</i><a href="/delete/{{auth()->user()->id}}/<?php echo $end;?>/{{$dir['dir']}}">delete</a><br/>
		
		@endfor
		<br>
		@endforeach
		
	</div>
@endif 
@endsection

