@extends('layout')

@section('title','Profile')

@section('content')
	<div class="pull-right">
		<div class="pull-left"><a href="{{url('/uploads')}}"><i class="fa fa-file fa-2x" aria-hidden="true">Upload</i></a></div>
		<div class="pull-right"><a href="{{url('/folder')}}"><i class="fa fa-folder fa-2x" aria-hidden="true">Create Folder</i></a></div>
	</div>
<h3>File Listing</h3>
	
	<!-- Start Of Table -->
<div>
	<div>
		 <table class="table">	
					@if(isset($directory))
					<?php $id = auth()->user()->id;  ?>
				
					<th>Folders and Files</th>
		
				@foreach($directory as $dir)
						<tr>
							<tr><td><i class="fa fa-folder fa-lg" aria-hidden="true">{{$dir['dir']}}</i></td>
							<td>Total files ({{$dir['count']}})</td>   
							<td><a href="{{url('/uploads/' . $dir['dir'])}}">upload</a></td>   
							<td><a href="{{url('/delete/'.$id.'/'.$dir['dir'])}}">delete</a></td>
							<td><a href="{{url('/empty/'.$id.'/'.$dir['dir'])}}">empty</a><br/></td></tr>
							<?php $count = count($dir['files']); ?>
							<?php  
							$i=0; ?>
							@for($i;$i<$count;$i++)
								<?php $file =$dir['files'][$i];

								$value = explode('/',$file);
								$end = end($value);

								$last = explode('.',$end);
								$extension = end($last);

								 ?>
							
							<tr class="border-none"><td ><i class="fa fa-file fa-sm" aria-hidden="true">{{$dir['files'][$i]}}</i></td>
								<td><?php echo($extension); ?> file </td>
								<td ><a href="{{url('/delete/'.$id.'/'.$dir['dir'].'/'.$end)}}">delete</a><br/></td>
							</tr>
							
							@endfor
							<br>
					</tr>
				@endforeach	
					
				@if(isset($out_file))
						 <div>
				<tr>
				<th>Files(<?php echo(count($out_file));?>)</th>
						@foreach($out_file as $file_o)

					<tr>
						
							<?php $outfile = explode('/',$file_o);
							    $file = end($outfile);?>
							
							<td><i class="fa fa-file fa-sm" aria-hidden="true">{{$file_o}}</i></td>    <td><a href="{{url('deletefile/'.$id.'/'. $file)}}">delete</a><br/></td>
							  
						@endforeach
					</tr>	
				</tr>
						</div>
				@endif
			
					
			</table>
	</div>
	<!--End of table -->

			@else
			<div>
			<p class="alert alert-info">Nothing to list</p>
			</div>
			@endif 
</div>			 
		@endsection

