<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->string('confirmation_token')->nullable()->unique()->after('email');
            $table->boolean('is_confirmed')->default(false)->after('confirmation_token');
            $table->timestamp('confirmed_at')->nullable()->after('is_confirmed');
        });
    }

    public function down(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn(['confirmation_token', 'is_confirmed', 'confirmed_at']);
        });
    }
};
