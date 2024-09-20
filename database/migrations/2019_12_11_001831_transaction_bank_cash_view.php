<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionBankCashView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW transaction_bank_cash_view AS
SELECT DISTINCT transactions.bank_cash_id, bank_cashes.name
            FROM 
            transactions 
            INNER JOIN bank_cashes 
            ON transactions.bank_cash_id=bank_cashes.id
            WHERE bank_cash_id IS NOT NULL  and transactions.deleted_at IS NULL
            ORDER BY bank_cash_id asc");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW transaction_bank_cash_view");

    }
}
