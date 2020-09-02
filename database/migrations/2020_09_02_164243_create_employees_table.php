<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('address_voivodeship', 100);
            $table->string('address_city', 100);
            $table->string('address_postal_code', 10);
            $table->string('address_street', 100);
            $table->string('address_number', 10);
            $table->string('correspondence_voivodeship', 100);
            $table->string('correspondence_city', 100);
            $table->string('correspondence_postal_code', 10);
            $table->string('correspondence_street', 100);
            $table->string('correspondence_number', 10);
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
        Schema::dropIfExists('employees');
    }
}
