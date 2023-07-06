<?php

use App\Models\HeadlessModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('headless_model_instances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignIdFor(
                model: HeadlessModel::class,
                column: 'model_id',
            );
            $table->json('attributes');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('headless_model_instances');
    }
};
