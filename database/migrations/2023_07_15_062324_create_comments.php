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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('post_id')->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Relationship with post table primary key (id) and users table primary key (id) with comment table
  // users relationship
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            // posts relationship 
            $table->foreign('post_id')
            ->references('id')->on('posts')
            ->restrictOnDelete()
            ->cascadeOnUpdate();




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
