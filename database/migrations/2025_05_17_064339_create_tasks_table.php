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
        Schema::create('tasks', function (Blueprint $table) {
          $table->id();
          $table->string('title');
            $table->unsignedBigInteger('designer_id'); 
            $table->unsignedBigInteger('township_id');
            $table->unsignedBigInteger('category_id');
                        $table->longText('description');

            $table->string('media_type'); // image, video, pdf
            $table->string('file_path'); // storage path
     $table->tinyInteger('status')->default(1)->comment('1=submitted, 2=approved, 3=rejected');
                $table->tinyInteger('publish_status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
