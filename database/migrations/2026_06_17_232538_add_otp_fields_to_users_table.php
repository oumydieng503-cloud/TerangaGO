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
    Schema::table('users', function (Blueprint $table) {
        $table->string('telephone', 9)->unique()->nullable()->after('email');
        $table->string('otp_code', 4)->nullable();
        $table->timestamp('otp_expires_at')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['telephone', 'otp_code', 'otp_expires_at']);
    });
}
};
