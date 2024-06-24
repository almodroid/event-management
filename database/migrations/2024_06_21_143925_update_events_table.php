<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('start_date')->after('description');
            $table->dateTime('end_date')->after('start_date');
            $table->integer('available_tickets')->after('end_date');
            $table->integer('max_ticket_quantity_per_customer')->after('available_tickets');
            $table->integer('min_ticket_quantity_per_customer')->default(1)->after('max_ticket_quantity_per_customer');
            $table->string('tags')->nullable()->after('min_ticket_quantity_per_customer');
            $table->string('image')->nullable()->after('tags');
            $table->dropColumn('date');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('available_tickets');
            $table->dropColumn('max_ticket_quantity_per_customer');
            $table->dropColumn('min_ticket_quantity_per_customer');
            $table->dropColumn('tags');
            $table->dropColumn('image');
            $table->dateTime('date')->after('description');
        });
    }
}