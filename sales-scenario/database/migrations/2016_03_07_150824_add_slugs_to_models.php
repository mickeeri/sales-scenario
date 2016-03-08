<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugsToModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->string('slug')->after('id')->unique();
        });

        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('slug')->after('id')->unique();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('slug')->after('id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('podcasts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
