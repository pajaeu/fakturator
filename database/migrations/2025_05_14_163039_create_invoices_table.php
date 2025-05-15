<?php

declare(strict_types=1);

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number')->index();
            $table->string('variable_symbol')->nullable();
            $table->date('issued_at');
            $table->date('due_at');
            $table->double('total');
            $table->double('total_with_vat');
            $table->string('currency_code')->default('CZK');
            $table->string('currency_symbol')->default('Kč');
            $table->string('supplier_company');
            $table->string('supplier_address');
            $table->string('supplier_city');
            $table->string('supplier_country');
            $table->string('supplier_zip');
            $table->string('customer_company');
            $table->string('customer_company_id');
            $table->string('customer_vat_id')->nullable();
            $table->string('customer_address');
            $table->string('customer_city');
            $table->string('customer_country');
            $table->string('customer_zip');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('contact_id')->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['number', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
