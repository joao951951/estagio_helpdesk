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
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('title');
            $table->text('claimed_defect'); // Defeito reclamado
            $table->text('found_defect')->nullable(); // Defeito constatado
            $table->text('service_performed')->nullable();
            $table->text('swap_parts')->nullable();
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('status');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('priority_id')->references('id')->on('priorities');
            $table->foreign('status')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
