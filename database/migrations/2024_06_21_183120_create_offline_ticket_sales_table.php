<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineTicketSalesTable extends Migration
{
    public function up()
    {
        Schema::create('offline_ticket_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('quantity_sold');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offline_ticket_sales');
    }
}