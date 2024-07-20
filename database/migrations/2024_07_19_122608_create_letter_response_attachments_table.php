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
        Schema::create('letter_response_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('response_id')->index('respond')->comment('Response against which response files are attached.');
            $table->text('response_attachment')->comment('Attachement file against response of a department.');
            $table->timestamps();
            $table->foreign('response_id')->references('id')->on('letter_action_responses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_response_attachments');
    }
};
