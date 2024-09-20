<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionBranchView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW transaction_branch_view AS
        
        SELECT DISTINCT branch_id, name
        FROM 
        transactions
        INNER JOIN branches 
        ON 
        transactions.branch_id =branches.id
        WHERE transactions.branch_id IS NOT NULL  AND transactions.deleted_at IS NULL
        ORDER BY branch_id asc
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW transaction_branch_view");
    }
}
