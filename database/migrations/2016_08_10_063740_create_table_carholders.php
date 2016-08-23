<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCarholders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carholders',function(Blueprint $table){
            $table->increments('id');
            $table->string('customer_name');
            $table->string('carmodel');
            $table->date('manufacturing_year');
            $table->text('feedback');
            $table->string('car_image');
            $table->rememberToken();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carholders');
    }
}
