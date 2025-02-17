<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title");
            $table->string("description");
            $table->timestamps();
        });

        Schema::create('topics', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title");
            $table->string("content");
            $table->uuid('group_id'); // Use UUID instead of foreignId
            $table->bigInteger('user_id'); // Use UUID for user if needed
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title")->nullable();
            $table->string("content");
            $table->uuid('parent_id')->nullable();
            $table->uuid('topic_id');
            $table->bigInteger('user_id');
            $table->timestamps();

            // Define foreign keys properly
            $table->foreign('parent_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('groups');
    }
};
