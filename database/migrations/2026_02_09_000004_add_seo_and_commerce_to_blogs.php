<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('blog_slug')->unique()->after('blog_title')->nullable();
            $table->string('meta_description')->nullable()->after('blog_tags');
            $table->string('meta_image')->nullable()->after('meta_description');
            $table->json('related_products')->nullable()->after('meta_image')->comment('Array of SKU/Product IDs');
            $table->foreignId('blog_category_id')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['blog_slug', 'meta_description', 'meta_image', 'related_products', 'blog_category_id']);
        });
    }
};
