@extends('layouts.pdf')

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')

    <?php
    $transaction = new \App\Transaction();
    ?>

    <div class="mid">
        @foreach($branch_ids as $branch_id)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                    <table>
                        <tr>
                            <th valign="middle" colspan="9">
                                <h1><b>{{ App\Branch::find($branch_id)->name  }}</b></h1>
                            </th>
                        </tr>
                    </table>
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col"><b>SL. No</b></th>
                            <th scope="col"><b>Date</b></th>
                            <th scope="col"><b>Head Of Account</b></th>
                            <th scope="col"><b>Mode Of Payment</b></th>
                            <th scope="col"><b>Cheque Number</b></th>
                            <th scope="col"><b>Particulars</b></th>
                            <th scope="col"><b>Voucher No</b></th>
                            <th scope="col"><b>Type Of Voucher</b></th>
                            <th class="text-right" scope="col"><b>Debit
                                    ( <?php echo (config('settings.is_code') == 'code') ?
                                        config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                                </b></th>
                            <th class="text-right" scope="col"><b>Credit
                                    ( <?php echo (config('settings.is_code') == 'code') ?
                                        config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                                </b></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $index = 1;
                        $dr_amount = 0;
                        $cr_amount = 0;

                        ?>

                        @foreach($items as $item)
                            @if($branch_id != $item->branch_id)
                                @continue;
                            @endif
                            <?php $income_expense_head_name = null; ?>
                            <?php $bank_cash_name = null; ?>
                            @if(isset($item->income_expense_head_id))
                                <?php $income_expense_head_name = App\Transaction::find($item->id)->IncomeExpenseHead->name ?>
                            @endif

                            @if(isset($item->bank_cash_id))
                                <?php $bank_cash_name = App\Transaction::find($item->id)->BankCash->name ?>
                            @endif

                            <tr>
                                <th class="text-center" scope="row">{{ $index }}</th>
                                <td>{{ date(config('settings.date_format'), strtotime($item->voucher_date))   }}</td>
                                <td> {{ $income_expense_head_name  }} </td>
                                <td> {{ $bank_cash_name  }} </td>
                                <td> {{ $item->cheque_number   }} </td>
                                <td> {{ $item->particulars  }} </td>
                                <td class="text-center"> {{ $item->voucher_no  }} </td>
                                <td> {{ $item->voucher_type  }} </td>

                                <td class="text-right">{{  $item->dr }}</td>
                                <td class="text-right">{{  $item->cr }}</td>

                            </tr>
                            <?php $index++;
                            $dr_amount += $item->dr;
                            $cr_amount += $item->cr;
                            ?>
                        @endforeach
                        <tr>
                            <th align="right" colspan="8"><b>Total = </b></th>
                            <th class="text-right"><b>{{  $dr_amount }}</b></th>
                            <th class="text-right"><b>{{  $cr_amount }}</b></th>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
            <br>
        @endforeach
    </div>

@stop


