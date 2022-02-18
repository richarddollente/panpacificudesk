<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('subject');
            $table->string('category_id')->references('id')->on('category')->cascadeOnDelete();
            $table->string('status_id')->references('id')->on('status')->cascadeOnDelete();
            $table->string('priority_id')->references('id')->on('priority')->cascadeOnDelete();
            $table->string('description');
            $table->string('ticket_file')->nullable();
            $table->foreignId('admin_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
