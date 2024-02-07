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
        Schema::create('mail_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('hash')->index();
            $table->enum('status', ['Sending', 'Sent'])->default('Sending');
            $table->json('headers');
            $table->text('body')->nullable();
            $table->json('content')
                ->comment('Default we have text, text-charset and html key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_histories');
    }
};
