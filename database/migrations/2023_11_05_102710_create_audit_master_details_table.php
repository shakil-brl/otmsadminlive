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
        Schema::create('audit_master_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auditmaster_id');
            $table->foreignId('audittasks_id');
            $table->text('remark');
            $table->text('document')->nullable();
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
        Schema::dropIfExists('audit_master_details');
    }
};