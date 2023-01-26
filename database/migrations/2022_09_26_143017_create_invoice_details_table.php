<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_Invoice')->constrained('invoices')->cascadeOnDelete();
            $table->string('invoice_number', 50);
            $table->string('product', 50);
            $table->string('Section', 999);
            $table->string('Status', 50);
            $table->integer('Value_Status');
            $table->date('Payment_Date')->nullable();
            $table->text('note')->nullable();
            $table->string('user',200);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices_details');
    }
};
