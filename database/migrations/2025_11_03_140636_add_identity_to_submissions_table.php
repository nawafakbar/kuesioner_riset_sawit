<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Tambahkan 2 kolom ini setelah 'id'
            $table->string('nama')->after('id');
            $table->string('email')->after('nama');
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Kebalikan dari 'up' jika kita perlu rollback
            $table->dropColumn(['nama', 'email']);
        });
    }
};