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
            $table->string('tittle');
            $table->text('claimed_defect'); // Defeito reclamado
            $table->text('found_defect')->nullable(); // Defeito constatado
            $table->text('service_performed')->nullable();
            $table->text('swap_parts')->nullable();
            $table->string('priority');
            $table->string('status');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('employee_id')->references('id')->on('employees');
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
