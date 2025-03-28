<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publisher_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('cover_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();

            $table->unsignedTinyInteger('mac_support')->default(0);
            $table->decimal('price', 8, 2)->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->date('release_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
