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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('json_data_id')->unique();
            $table->string('type');
            $table->string('brand');
            $table->string('model');
            $table->string('version');
            $table->string('doors');
            $table->string('board');
            $table->string('chassi')->nullable();
            $table->string('transmission');
            $table->string('km');
            $table->text('description')->nullable();
            $table->timestamp('created_json');
            $table->timestamp('updated_json');
            $table->boolean('sold')->default(false);
            $table->string('category');
            $table->string('url_car');
            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2);
            $table->string('color');
            $table->string('fuel');
            $table->json('year');
            $table->json('optionals');
            $table->json('fotos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
