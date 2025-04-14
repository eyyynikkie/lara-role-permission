<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Check if the column already exists before adding it
            if (!Schema::hasColumn('posts', 'has_affiliate_links')) {
                $table->boolean('has_affiliate_links')->default(false);
            }
    
            if (!Schema::hasColumn('posts', 'affiliate_disclaimer')) {
                $table->string('affiliate_disclaimer')->nullable();
            }
    
            if (!Schema::hasColumn('posts', 'affiliate_product_url')) {
                $table->string('affiliate_product_url')->nullable();
            }
        });
    }
    
    
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['has_affiliate_links', 'affiliate_disclaimer', 'affiliate_product_url']);
        });
    }
};
