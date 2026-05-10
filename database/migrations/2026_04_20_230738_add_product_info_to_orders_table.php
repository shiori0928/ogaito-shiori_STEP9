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
    Schema::table('orders', function (Blueprint $table) {
        $table->string('product_name')->after('total_price');
        $table->text('product_description')->after('product_name');
        $table->integer('price')->after('product_description');
        $table->integer('quantity')->after('price');
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn([
            'product_name',
            'product_description',
            'price',
            'quantity'
        ]);
    });
}
};
