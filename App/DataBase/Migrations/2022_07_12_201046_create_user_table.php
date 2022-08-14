<?php

namespace App\DataBase\Migrations;

use Zeero\Database\Migration;
use Zeero\Database\QueryBuilder\SchemaBuilder\Table;
use Zeero\facades\Schema;

class CreateUserTable extends Migration
{

	public function up() 
	{
		Schema::create('user', function (Table $table) {
			$table->uuid('uuid');
			$table->string('name')->size(255);
			$table->string('email')->size(100);
			$table->string('password')->size(255);
			$table->enum('online', ['0', '1'])->default(0);
			$table->enum('level', ['1', '2', '3'])->default(3);
			$table->datetime('created_at');
			$table->datetime('updated_at')->nullable();
			$table->engine('InnoDB');
		});
	}

	public function down() 
	{
		Schema::dropIfExists('user');
	}

}
