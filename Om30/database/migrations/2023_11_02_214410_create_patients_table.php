<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePatientsTable.
 */
class CreatePatientsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table) {
            $table->id();
            $table->string('full_name', 150);
            $table->string('full_name_mom', 150)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('cns', 18)->unique()->nullable();
            $table->date('date_of_birth')->nullable();
            $table->bigInteger('address_id')->nullable();
            $table->softDeletes();
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
		Schema::drop('patients');
	}
}
