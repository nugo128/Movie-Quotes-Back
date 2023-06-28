<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('new_emails', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->foreignId('user_id')->nullable();
			$table->string('email')->nullable();
			$table->string('verification_token')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('new_email');
	}
};
