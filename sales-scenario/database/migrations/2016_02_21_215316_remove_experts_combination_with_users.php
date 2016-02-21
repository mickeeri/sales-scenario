<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveExpertsCombinationWithUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->dropForeign('experts_user_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down()
    {
        //TODO Not sure about down here! //Andréas
        Schema::table('experts', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
}
