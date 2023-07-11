<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->index();
            $table->foreign('doctor_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('patient_id')->index();
            $table->foreign('patient_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('hospital_id')->index();
            $table->foreign('hospital_id')->references('id')->on('hospitals')->cascadeOnDelete();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->double('fee')->default(0.0);
            $table->double('discount')->default(0.0);
            $table->float('vat')->default(0.0);
            $table->string('status', 1)->default(0);
            $table->enum('payment_status', ["Paid", "Unpaid"])->default("Unpaid");
            $table->datetime('payment_date')->nullable();
            $table->bigInteger("status_changed_by")->unsigned()->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
