<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CarRequest;
use App\Http\Requests\RequestView;

use App\Register;
use App\Carholder;

class CarController extends Controller
{
    public function register(){
    	return view('car.register');
    }

    public function userstore(CarRequest $request){

      
    	$car = Register::create([
    		'username' => $request->input('username'),
    		'emai' => $request->input('email'),
    		'password' => bcrypt($request->input('password')),
    		'image' => $request->input('image')]);
    	if($car->save()){
    		return view('car.login')->with(['message' => 'successfully registered']);    	
    	}
    	else{
    		return back()->withInput()->with($error);
    	}
    }
    public function login(Request $request){
        return view('car.login');
    }

    public function loginpost(Request $request){
    		$email = $request->input('email');
    		$password  = bcrypt($request->input('password'));
    	   	$login = Register::where(['email' => $email, 'password' => $password]);

            $car = Carholder::latest('id');

            if(count($login) == 1){
                //print_r("hdgedsyfgds");die();
                return redirect(route('cars-listing'))->with(['message' => 'You have been logged successfully','car' => $car]);
            }
            else{
                return back()->withInput()->with($error);
            }
    	   	
    }
    public function index(){

        $car = Carholder::latest('id')->get();

        return view('car.carlist')->with(['car' =>$car]);
    }
    public function create(){
            return view('car.create');
    }
    public function store(RequestView $request){
       
        $car = Carholder::create(['customer_name'=>$request->input('holdername'),
        'carmodel' => $request->input('carmodel'),
        'manufacturing_year' => $request->input('year'),
        'feedback' => $request->input('feedback'),
        'car_image' => $request->file('carimage')]);

        if($car->save()){
            $car->car_image = $this->imageUpload($request);
            $car->save();
            return redirect(route('cars-listing'));
        }
        else{
            return back()->withInput()->with($error);
        }
    }
    public function edit(Request $request,$id){

        $car = Carholder::findOrFail($id);
        //echo "<pre>";
        //print_r($car);die();
        if($car){
        return view('car.edit')->with(['car' => $car]);
    
        }
    }
    public function update(RequestView $request,$id){

            $car = Carholder::findOrFail($id);
            $car->customer_name = $request->input('holdername');
            $car->carmodel = $request->input('carmodel');
            $car->manufacturing_year = $request->input('year');
            $car->feedback = $request->input('feedback');
            $car->car_image = $this->imageUpload($request);
            $car->save();
            //$car->car_image = $request->input('carimage');

           if($car->save()){
            return redirect(route('cars-listing'))->with(['message' => 'Your details updated successfully']);
           } 
    }
    public function imageUpload(Request $request){

        if($request->hasFile('carimage')){
           
         $file = $request->file('carimage');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $destinationPath = base_path() . '\public\image/';
        $image = $request->file('carimage')->move($destinationPath, $filename);
        return $filename;
        }
    }
    public function destroy(Request $request,$id){
        $car = Carholder::findOrFail($id);
        //print_r($car);die();
        if($car->delete()){
            return redirect(route('cars-listing'))->with(['message'=>'Your car details successfully']);
        }
        else{
            return back()->with(['message' => 'Sorry! your car details are not deleted']);
        }
    }
}
