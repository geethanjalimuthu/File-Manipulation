<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Storage;

use App\Upload;

use App\User;

use App\Http\Requests\RegisterRequest;

class UploadController extends Controller
{
	public function register(){
    	
    	return view('auth.register');
    }

    public function postregister(RegisterRequest $request){

    	$user = User::create([
    		'name'=> $request->input('name'),
    		'email' => $request->input('email'),
    		'password' => bcrypt($request->input('password'))]);
    		if($user){
    			return redirect('login')->with(['message' =>'Registered successfully']);
    		}
    		else{
    			return back()->withInputs()->with($error);
    		}
    }
	public function profile(Request $request){

		$id = auth()->user()->id;
		$directory = Storage::allDirectories('public/uploads/'.$id);
		
		if($directory){ 
				$out_file =  Storage::allFiles('public/uploads/'.$id);
					
				foreach ($directory as $directories) {
					
					$direct = explode('/',$directories);
				
					  	$valid = 'public/uploads/'.$id.'/'.end($direct); 	 
					  	
					  	 	$file = Storage::allFiles($valid);

								
								$result_dir[] = array('dir' => end($direct), 'files' => $file,'count'=> count($file));	
					}
			
		}
		
    	return view('auth.profile')->with(['directory' => $result_dir,'out_file' => $out_file]);
    }

    public function uplds(){
    	return view('auth.uploadfile');
    }

    public function postuplds(Request $request){
    	//print_r(\Request::all());die();
    	$this->validate($request,['file'=>'required|file']);
    	$id = auth()->user()->id;
    	$files=$request->file('file');
    	$filename = $request->file('file')->getClientOriginalName();
    	$folder = $request->input('folder');
    	
    	$check = Storage::disk('local')->exists($id.'/'.$files);

    	if($check){

    			return back()->with(['message'=>'File already exists']);
    		    	}
    	else{

    		if($folder){

    		
    		Storage::put('public/uploads/'.$id.'/'.$folder.'/'.$filename,file_get_contents($request->file('file')->getRealPath()));
    		 
    	}
    	else{
    	
    		
    		Storage::put('public/uploads/'.$id.'/'.$filename,file_get_contents($request->file('file')->getRealPath()));
    		
    	}
    	$upload = Upload::create(['user_id'=>$id,'upfile'=> $filename]);

	    	if($upload){
	    		return redirect('profile')->with(['folder'=>$folder,'message'=>'File uploaded successfully']);
	    	}
	    	else{
	    		return back()->withInput()->with(['message'=>'Sorry your file does not upload']);
	    	}
    	}

    	
    }

    public function getfolder(){
    	return view('uploads.upshow');
    }

    public function postfolder(Request $request){

    	$this->validate($request,['folder' => 'required']);
    	$folder = $request->input('folder');

    	$id = auth()->user()->id;

    	$check = Storage::disk('local')->exists('uploads/'.$id.'/'.$folder);
    	if(!($check)){
    		
    		$directory = 'public/uploads/'.$id.'/'.$folder;
    		Storage::makeDirectory($directory);
    		return view('uploads.foldercreate',compact('folder'));
    	}
    }
   public function destroy(Request $request,$id,$dir,$file=''){
   
	   	if($file){
	   		$delete = 'public/uploads/'.$id.'/'.$dir.'/'.$file;
	   		$del = Storage::delete($delete);

	   }
	   else{
	   		$delete = 'public/uploads/'.$id.'/'.$dir;
	   		$del = Storage::deleteDirectory($delete);
	  }
	   		if($del){
	   			return redirect('profile')->with(['message'=>'Your file or folder deleted successfully']);
	   		}
   }
   public function filedestroy(Request $request,$id,$file){
   		$delete = 'public/uploads/'.$id.'/'.$file;
   		$del = Storage::delete($delete);

   			if($del){
   			return redirect('profile')->with(['message'=>'Your file deleted successfully']);
   			}
   }
   public function emptyfolder(Request $request,$id,$dir){
   		$empty = 'public/uploads/'.$id.'/'.$dir;
   		$file = Storage::allFiles($empty);

   		$delete = Storage::delete($file);

   		if($delete){
   			return redirect('profile')->with(['message'=>'Your folder files are all deleted successfully']);
   		}
   		else{
   			return redirect('profile')->with(['message'=>'Folder files are not deleted']);
   		}
   }

  /** public function destroy(Request $request,$id,$file='',$dir=''){
   	if($dir){
   		if($file){
   			$delete = 'public/uploads/'.$id.'/'.$dir.'/'.$file;
   	$del = Storage::delete($delete);
   		}
   		else{
   			$delete = 'public/uploads/'.$id.'/'.$dir;
   		$del = Storage::deleteDirectory($delete);
   		}
   	}
   	else{
   		$delete = 'public/uploads/'.$id.'/'.$file;
   		$del = Storage::delete($delete);
   	}
   }*/
}
