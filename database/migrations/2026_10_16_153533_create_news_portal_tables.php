
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_header')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['category_id', 'slug']);
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('subcategories')
                ->nullOnDelete();

            $table->foreignId('author_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');

            $table->string('featured_image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('facebook_url')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('focus_keyword')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->unsignedInteger('pin_order')->default(0);

            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['category_id', 'published_at']);
        });

        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('selection_mode')->default('latest');
            $table->unsignedInteger('display_limit')->default(10);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('news_homepage_section', function (Blueprint $table) {
            $table->id();

            $table->foreignId('news_id')
                ->constrained('news')
                ->cascadeOnDelete();

            $table->foreignId('homepage_section_id')
                ->constrained('homepage_sections')
                ->cascadeOnDelete();

            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(
                ['news_id', 'homepage_section_id'],
                'news_section_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_homepage_section');
        Schema::dropIfExists('homepage_sections');
        Schema::dropIfExists('news');
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('categories');
    }
};
