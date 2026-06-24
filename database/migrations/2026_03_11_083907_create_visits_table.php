<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45); 
            $table->string('user_agent')->nullable();
            $table->string('page_url');
            $table->string('referer')->nullable(); 
            $table->timestamps();

            $table->index('page_url');
            $table->index('created_at');
        });
    }

    public function down(): void {
        Schema::dropIfExists('visits');
    }
};