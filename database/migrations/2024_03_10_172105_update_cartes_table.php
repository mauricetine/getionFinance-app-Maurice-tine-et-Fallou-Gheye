<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cartes', function (Blueprint $table) {
            if (!Schema::hasColumn('cartes', 'numero_carte')) {
                $table->string('numero_carte')->after('user_id');
            }

            if (!Schema::hasColumn('cartes', 'date_carte')) {
                $table->string('date_carte')->after('numero_carte');
            }

            if (!Schema::hasColumn('cartes', 'date_expiration')) {
                $table->string('date_expiration')->after('date_carte');
            }

            if (!Schema::hasColumn('cartes', 'cvv')) {
                $table->string('cvv')->after('date_expiration');
            }

            $cartes = DB::table('cartes')->get();

            foreach ($cartes as $carte) {
                $numeroCarte = $this->generateRandomCardNumber();
                $dateCarte = $this->generateRandomCardDate();
                $dateExpiration = $this->generateRandomCardExpiration();
                $cvv = $this->generateRandomCVV();
                DB::table('cartes')->where('id', $carte->id)->update([
                    'numero_carte' => $numeroCarte,
                    'date_carte' => $dateCarte,
                    'date_expiration' => $dateExpiration,
                    'cvv' => $cvv,
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartes', function (Blueprint $table) {
            if (Schema::hasColumn('cartes', 'numero_carte')) {
                $table->dropColumn('numero_carte');
            }

            if (Schema::hasColumn('cartes', 'date_carte')) {
                $table->dropColumn('date_carte');
            }

            if (Schema::hasColumn('cartes', 'date_expiration')) {
                $table->dropColumn('date_expiration');
            }

            if (Schema::hasColumn('cartes', 'cvv')) {
                $table->dropColumn('cvv');
            }
        });
    }
    

    function generateRandomCardNumber(): string
{
    $blocks = [];
    for ($i = 0; $i < 4; $i++) {
        $block = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $blocks[] = $block;
    }
    return implode(' ', $blocks);
}

function generateRandomCardDate(): string
{
    $month = str_pad(mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
    $year = str_pad(mt_rand(22, 27), 2, '0', STR_PAD_LEFT);
    return $month . '/' . $year;
}

function generateRandomCardExpiration(): string
{
    $month = str_pad(mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
    $year = str_pad(mt_rand(30, 35), 2, '0', STR_PAD_LEFT);
    return $month . '/' . $year;
}

function generateRandomCVV(): string
{
    return str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
}
};
