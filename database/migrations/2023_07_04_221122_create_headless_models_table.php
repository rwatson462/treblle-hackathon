<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('headless_models', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 255)->nullable(false);
            $table->text('attributes')->nullable(false);

            $table->foreignIdFor(User::class);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('headless_models');
    }
};
