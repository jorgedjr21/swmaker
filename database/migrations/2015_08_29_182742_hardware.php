<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hardware extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hardware',function($table){
            $table->increments('id');
            $table->json('data');
            $table->timestamps();
        
        });
        
        Schema::create('onoff', function($table){
            $table->increments('id');
            $table->boolean('status')->default(false);
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
        //
        Schema::drop('hardware');
        Schema::drop('onoff');
    }
}
