<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTicketsTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->boolean('is_scanned')->default(false);
            $table->date('date');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('is_scanned');
            $table->dropColumn('date');
            $table->dropForeign(['scanned_by']);
            $table->dropColumn('scanned_by');
        });
    }
}

