<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            // Drop the existing application_type_id column if it exists
            if (Schema::hasColumn('activities', 'application_type_id')) {
                $table->dropForeign(['application_type_id']);
                $table->dropColumn('application_type_id');
            }

            // Add the new institution_id column
            $table->unsignedBigInteger('institution_id')->after('name');

            // Set up foreign key relationship
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            // Remove the foreign key and column for institution_id
            $table->dropForeign(['institution_id']);
            $table->dropColumn('institution_id');

            // Add back the application_type_id column if needed
            $table->unsignedBigInteger('application_type_id')->after('name');

            // Set up foreign key relationship
            $table->foreign('application_type_id')->references('id')->on('application_types')->onDelete('cascade');
        });
    }
}
