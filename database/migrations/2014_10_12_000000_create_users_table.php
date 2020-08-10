<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->integer('role_id')->unsiged()->nullable()->index()->default();
            $table->integer('company_id')->unsiged()->nullable()->index()->default(NULL);
            $table->string('email')->unique();
            $table->integer('is_active')->unsiged()->index()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->text('bio')->nullable();
            $table->string('position')->nullable();
            $table->string('password');
            $table->string('user_type');
            $table->ipAddress('signup_ip')->nullable();
            $table->string('ip_country')->nullable();
            $table->rememberToken()->nullable();
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
        Schema::dropIfExists('users');
    }
}
