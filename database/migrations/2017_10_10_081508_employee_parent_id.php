<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeParentId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Add PID (Boss id)
         */
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('pid')->unsigned()->after('position_id');//->nullable();
            //$table->foreign('pid')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
           // $table->dropForeign(['pid']);
            $table->dropColumn('pid');
        });
    }
}
