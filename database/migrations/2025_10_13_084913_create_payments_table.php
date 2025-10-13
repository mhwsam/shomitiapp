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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('member_id')->constrained()->cascadeOnDelete();
        $table->unsignedSmallInteger('year');
        $table->unsignedTinyInteger('month'); // 1..12
        $table->unsignedInteger('amount_due')->default(0);
        $table->unsignedInteger('amount_paid')->default(0);
        $table->dateTime('paid_on')->nullable();
        $table->enum('method', ['Cash','bKash','Nagad','Bank'])->nullable();
        $table->string('reference_no')->nullable();
        $table->foreignId('collected_by')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamps();

        $table->unique(['member_id','year','month']);
        $table->index(['year','month']);
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
