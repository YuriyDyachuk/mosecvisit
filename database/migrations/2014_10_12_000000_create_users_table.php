<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->default(DB::raw('(UUID())'))->index();
            $table->string('full_name')->nullable()->index();
            $table->string('login')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('company_name')->unique();
            $table->tinyInteger('role_id');
            $table->tinyInteger('verify')->default(0);
            $table->string('link_qrcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
