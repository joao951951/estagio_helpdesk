<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('descri')->nullable();

            //Valores Antigos
            $table->unsignedBigInteger('employee_id_old')->nullable();
            $table->string('title_old')->nullable();
            $table->text('claimed_defect_old')->nullable(); // Defeito reclamado
            $table->text('found_defect_old')->nullable(); // Defeito constatado
            $table->text('service_performed_old')->nullable();
            $table->text('swap_parts_old')->nullable();
            $table->unsignedBigInteger('priority_id_old')->nullable();
            $table->unsignedBigInteger('status_old')->nullable();

            //Valores Atualizados
            $table->string('title_new');
            $table->text('claimed_defect_new'); // Defeito reclamado
            $table->text('found_defect_new')->nullable(); // Defeito constatado
            $table->text('service_performed_new')->nullable();
            $table->text('swap_parts_new')->nullable();
            $table->unsignedBigInteger('priority_id_new');
            $table->unsignedBigInteger('status_new');

            $table->timestamps();


            $table->foreign('ticket_id')->references('id')->on('tickets');
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
        Schema::dropIfExists('ticket_employees');
    }
}
