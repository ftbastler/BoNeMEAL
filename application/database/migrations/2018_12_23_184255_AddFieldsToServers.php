<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToServers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('servers', function(Blueprint $table)
		{
			$table->boolean('db_ssl')->default(false);
			$table->string('db_key')->comment('Client Public Key')->nullable();
            $table->string('db_cert')->comment('Client Public Certificate')->nullable();
            $table->string('db_ca')->comment('Database CA Certificate')->nullable();
            $table->integer('db_port')->default(3306)->comment('Database connection port');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servers', function(Blueprint $table)
		{
			$table->dropColumn('db_ssl','db_key','db_cert','db_ca','db_port');
		});
	}

}
