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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('application_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('institution_id')->nullable()->constrained()->onDelete('set null'); // Make column nullable
            $table->foreignId('activity_id')->nullable()->constrained()->onDelete('set null'); // Ensure this column is nullable
            $table->date('preferred_start_date')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_letter')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
