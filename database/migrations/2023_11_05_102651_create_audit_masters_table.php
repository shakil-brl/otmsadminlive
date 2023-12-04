<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_masters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('batche_id');
            $table->tinyInteger('status')->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('Updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_masters');
    }
};