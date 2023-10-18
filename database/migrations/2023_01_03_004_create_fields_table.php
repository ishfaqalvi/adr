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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_group_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['text', 'number', 'email', 'file', 'select', 'textarea']);
            $table->string('name');
            $table->string('placeholder')->nullable();
            $table->string('label')->nullable();
            $table->text('options')->nullable();
            $table->boolean('is_required')->default(0);
            $table->boolean('is_editor')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
};
