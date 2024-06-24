<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToOrganizersTable extends Migration
{
    public function up()
    {
        Schema::table('organizers', function (Blueprint $table) {
            $table->string('password')->after('email');
        });
    }

    public function down()
    {
        Schema::table('organizers', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
}
