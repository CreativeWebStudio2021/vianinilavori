<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * I campi ruolo/mansione del form "Lavora con noi" accettano testi lunghi;
     * varchar(150/255) faceva fallire l'insert (SQLSTATE 1406).
     */
    public function up(): void
    {
        if (! Schema::hasTable('lavora_con_noi')) {
            return;
        }

        DB::statement('ALTER TABLE lavora_con_noi MODIFY ruolo_attuale TEXT NOT NULL, MODIFY mansione_specifica TEXT NOT NULL');
    }

    public function down(): void
    {
        if (! Schema::hasTable('lavora_con_noi')) {
            return;
        }

        DB::statement('ALTER TABLE lavora_con_noi MODIFY ruolo_attuale VARCHAR(150) NOT NULL, MODIFY mansione_specifica VARCHAR(255) NOT NULL');
    }
};
