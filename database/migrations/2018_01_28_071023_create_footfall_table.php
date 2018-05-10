<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootfallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footfall', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('hostel_id')->nullable();
            $table->integer('caution_fees');
            $table->integer('acco_fees')->default(0);
            $table->integer('workshop_fees')->defaul(0);
            $table->integer('reg_fees');
            $table->integer('total_amt');
            $table->string('workshop_name');
            $table->boolean('paid_online')->default(0);
            $table->boolean('pr_paid')->default(0);
            $table->boolean('acco_paid')->default(0);
            $table->integer('checkin')->nullable();
            $table->integer('checkout')->nullable();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('footfall');
    }
}
