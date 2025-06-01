<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('billing_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email', 255)->nullable();
            $table->string('phone', 16);
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('division');
            $table->string('post_code');
            $table->string('country');
            $table->string('order_notes')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_infos');
    }
};
