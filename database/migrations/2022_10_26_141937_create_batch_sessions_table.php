<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('batch_id');
            $table->enum('class_type', ['online', 'physical']);
            $table->enum('physical_class_type', ['group', 'in_person'])->nullable();
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
        Schema::dropIfExists('batch_sessions');
    }
}
