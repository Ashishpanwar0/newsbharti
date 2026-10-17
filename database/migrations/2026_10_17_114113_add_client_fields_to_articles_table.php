<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('subcategory_id')->nullable()->after('category_id')
                  ->constrained('categories')->nullOnDelete();
            $table->string('reporter_name')->nullable()->after('author_id');

            $table->string('focus_keyword')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description', 320)->nullable();
            $table->string('og_image')->nullable();

            $table->string('image_alt')->nullable();
            $table->json('gallery')->nullable();

            $table->boolean('is_pinned')->default(false);
            $table->unsignedInteger('pin_priority')->default(0);
            $table->string('homepage_section')->nullable();

            $table->dropColumn('is_featured'); // replaced by is_pinned
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('subcategory_id');
            $table->dropColumn([
                'reporter_name', 'focus_keyword', 'canonical_url',
                'og_title', 'og_description', 'og_image',
                'image_alt', 'gallery',
                'is_pinned', 'pin_priority', 'homepage_section',
            ]);
            $table->boolean('is_featured')->default(false);
        });
    }
};