<?php

use App\Domain\Segment\Models\Segment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('segments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->json('rules');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('segment_customer', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Segment::class)->constrained()->onDelete('cascade');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segments');
        Schema::dropIfExists('segment_customer');
    }
};
