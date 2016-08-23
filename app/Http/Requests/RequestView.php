<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequestView extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //echo '<pre>';
       // print_r(\Request::all());die();
       $rules = ['holdername' => 'required',
            'carmodel' => 'required',
            'year' => 'required',
            'feedback' => 'required',
            'carimage' => 'required|image'];
            
        return $rules;
    }
}
