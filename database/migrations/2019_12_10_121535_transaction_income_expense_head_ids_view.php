<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionIncomeExpenseHeadIdsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("CREATE OR REPLACE VIEW transaction_income_expense_head_ids_view AS
                        SELECT DISTINCT 
income_expense_head_id, income_expense_heads.name AS income_expense_head_name , income_expense_heads.type
FROM 
transactions
INNER JOIN income_expense_heads
on
transactions.income_expense_head_id=income_expense_heads.id
WHERE income_expense_head_id IS  NOT NULL  and transactions.deleted_at IS NULL
ORDER BY income_expense_head_id ASC");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW transaction_income_expense_head_Ids_view");
    }
}
