<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('job')->nullable();
            $table->string('quote')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->string('skin_image_url')->nullable();
            $table->string('head_skin_image_url')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('owners'); }
};
