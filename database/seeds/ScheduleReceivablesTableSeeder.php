<?php

use Illuminate\Database\Seeder;

class ScheduleReceivablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ScheduleReceivable::create([
            'sells_id'=>1,
            'term'=> 'Booking Money',
            'payable_amount'=> '1000000',
            'schedule_date'=> '05/01/2020',
        ]);

        App\ScheduleReceivable::create([
            'sells_id'=>1,
            'term'=> 'Down Payment',
            'payable_amount'=> '7500000',
            'schedule_date'=> '07/31/2020',
        ]);

        App\ScheduleReceivable::create([
            'sells_id'=>1,
            'term'=> '1st Installment',
            'payable_amount'=> '2580000',
            'schedule_date'=> '09/30/2020',
        ]);

        App\ScheduleReceivable::create([
            'sells_id'=>1,
            'term'=> '2nd Installment',
            'payable_amount'=> '3300000',
            'schedule_date'=> '01/31/2021',
        ]);





         App\ScheduleReceivable::create([
            'sells_id'=>2,
            'term'=> 'Booking Money',
            'payable_amount'=> '15000000',
            'schedule_date'=> '05/31/2020',
        ]);

        App\ScheduleReceivable::create([
            'sells_id'=>2,
            'term'=> 'Down Payment',
            'payable_amount'=> '1000000',
            'schedule_date'=> '06/30/2020',
        ]);

        App\ScheduleReceivable::create([
            'sells_id'=>2,
            'term'=> '1st Installment',
            'payable_amount'=> '120000',
            'schedule_date'=> '07/31/2020',
        ]);

        App\ScheduleReceivable::create([
            'sells_id'=>2,
            'term'=> '2nd Installment',
            'payable_amount'=> '1280000',
            'schedule_date'=> '08/31/2020',
        ]);

        
        
        
    }
}
