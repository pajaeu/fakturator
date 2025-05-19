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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->index();
            $table->string('vat_id')->nullable();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('zip');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['company_id', 'user_id']);
        });
    }
};
