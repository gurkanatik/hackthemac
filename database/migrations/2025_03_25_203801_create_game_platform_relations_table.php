<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('platform_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->constrained()->cascadeOnDelete();
            $table->morphs('relation');
            $table->timestamps();

            $table->unique(['platform_id', 'relation_id', 'relation_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platform_relations');
    }
};
