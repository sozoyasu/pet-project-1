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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->boolean('is_active')->default(true);
            $table->text('short_text');
            $table->string('short_image', 255);
            $table->text('detail_text');
            $table->string('detail_image', 255);
            $table->timestamps();
        });

        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->timestamps();
        });

        Schema::create('blog_posts_categories', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('blog_posts');
            $table->foreignId('category_id')->constrained('blog_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts_categories');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('blog_posts');
    }
};
