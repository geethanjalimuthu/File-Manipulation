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
	public function profile(){

		$id = auth()->user()->id;
		$directory = Storage::allDirectories('public/uploads/'.$id);

		if($directory){ 

		foreach ($directory as $directories) {
			
			$direct = explode('/',$directories);
		
			  	$valid = 'public/uploads/'.$id.'/'.end($direct); 	 
			  	
			  	 	$file = Storage::allFiles($valid);
						
						$result_dir[] = array('dir' => end($direct), 'files' => $file);	
			}
	return view('auth.profile')->with(['directory' => $result_dir]);
	}else{
		return view('auth.profile');
	}
    	
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
    	//print_r($folder);die();
    	$check = Storage::disk('local')->exists($id.'/'.$files);

    	if($check){

    			echo "file exists";
    		    	}
    	else{

    		if($folder){

    		// $destination = storage_path().'app/uploads/'.$id.'/'.$folder;
    		Storage::put('public/uploads/'.$id.'/'.$folder.'/'.$filename,file_get_contents($request->file('file')->getRealPath()));
    		 //echo "fbdsfdf";
    	}
    	else{
    	
    		// $destination = storage_path().'app/uploads/'.$id;
    		Storage::put('public/uploads/'.$id.'/'.$filename,file_get_contents($request->file('file')->getRealPath()));
    		// echo "dsfgds";
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
   public function destroy(Request $request,$id,$file,$dir=''){
   if($file){
   		$delete = 'public/uploads/'.$id.'/'.$dir.'/'.$file;
   	$del = Storage::delete($delete);
   }
   else{
   		$delete = 'public/uploads/'.$id.'/'.$dir;
   		$del = Storage::deleteDirectory($delete);
  }
   		if($del){
   			return redirect('profile')->with(['message'=>'Your folder deleted successfully']);
   		}
   }
}
