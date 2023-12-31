<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('verification_token')->nullable();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('gauth_id')->nullable();
			$table->string('gauth_type')->nullable();
			$table->string('password')->nullable();
			$table->string('reset_token')->nullable();
			$table->string('profile_picture')->default('https://i.ibb.co/94kg8w7/profile.png')->nullable();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
