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
        Schema::create('audittasks', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('training_title_id');
            $table->tinyInteger('batchCode_id')->nullable();
            $table->text('subject')->nullable;
            $table->text('instruction')->nullable;
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
        Schema::dropIfExists('audittasks');
    }
};