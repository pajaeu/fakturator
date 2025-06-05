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
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_id')->nullable()->after('email')->unique()->index();
            $table->string('vat_id')->nullable()->after('company_id')->unique()->index();
            $table->string('billing_company')->nullable()->after('vat_id');
            $table->string('billing_address')->nullable()->after('billing_company');
            $table->string('billing_city')->nullable()->after('billing_address');
            $table->string('billing_country')->nullable()->after('billing_city');
            $table->string('billing_zip')->nullable()->after('billing_country');
        });
    }
};
