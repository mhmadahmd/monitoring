<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
         
            $table->date('birthday')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('img')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('address')->nullable();
            $table->integer('role');
            $table->boolean('account_status')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
