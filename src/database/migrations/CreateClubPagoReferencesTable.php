<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marketplace_clubpago_references', function (Blueprint $table) {
            $table->id();
            $table->string('orders_number');
            $table->decimal('amount', 10, 2);
            $table->string('currency')->nullable();
            $table->string('reference')->nullable();
            $table->string('authorization')->nullable();
            $table->string('bar_code')->nullable();
            $table->string('pay_format')->nullable();
            $table->text('message')->nullable();
            $table->string('folio')->nullable();
            $table->string('date')->nullable();
            $table->string('status');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketplace_clubpago_references');
    }
};
