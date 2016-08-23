<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carholder extends Model
{
    protected $fillable = ['customer_name','carmodel','manufacturing_year','feedback','car_image'];
}
