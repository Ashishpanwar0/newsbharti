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
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->restrictOnDelete();
        $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('author_id')->constrained('users')->restrictOnDelete();

        $table->string('headline');
        $table->string('slug')->unique();
        $table->text('summary')->nullable();
        $table->longText('body');
        $table->string('thumbnail')->nullable();

        $table->string('meta_title')->nullable();
        $table->string('meta_description', 320)->nullable();

        $table->string('youtube_url')->nullable();
        $table->string('facebook_url')->nullable();

        $table->string('status')->default('draft'); // draft, published
        $table->boolean('is_featured')->default(false);
        $table->timestamp('published_at')->nullable();
        $table->unsignedBigInteger('views')->default(0);

        $table->timestamps();
        $table->softDeletes();

        $table->index(['status', 'published_at']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
