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
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('member_no')->unique();             // e.g. M-0001
        $table->string('full_name_bn');
        $table->string('full_name_en')->nullable();
        $table->string('father_name')->nullable();
        $table->string('mother_name')->nullable();
        $table->string('spouse_name')->nullable();
        $table->enum('gender', ['male','female','other'])->nullable();
        $table->date('dob')->nullable();
        $table->string('nid_no')->nullable();
        $table->string('mobile')->index();
        $table->string('email')->nullable();
        $table->string('occupation')->nullable();

        $table->text('present_address')->nullable();
        $table->text('permanent_address')->nullable();
        $table->string('ward')->nullable();
        $table->string('post_office')->nullable();
        $table->string('thana')->nullable();
        $table->string('district')->nullable();
        $table->string('postal_code')->nullable();

        $table->date('join_date')->nullable();
        $table->enum('status', ['active','inactive'])->default('active');
        $table->string('photo_path')->nullable();
        $table->text('remarks')->nullable();

        $table->timestamps();
        $table->softDeletes();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
