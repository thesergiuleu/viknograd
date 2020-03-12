<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterApiMenuItemsTableAddTopPosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api_menu_items', function (Blueprint $table) {
            $table->tinyInteger('top_position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_menu_items', function (Blueprint $table) {
            $table->dropColumn('top_position');
        });
    }
}
