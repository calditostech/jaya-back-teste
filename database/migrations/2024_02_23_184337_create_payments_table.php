<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->float('transaction_amount');
            $table->integer('installments');
            $table->string('token');
            $table->string('payment_method_id');
            $table->string('entity_type');
            $table->string('type');
            $table->string('email');
            $table->string('identification_type');
            $table->string('identification_number');
            $table->string('notification_url')->nullable();
            $table->date('created_at');
            $table->date('updated_at');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
