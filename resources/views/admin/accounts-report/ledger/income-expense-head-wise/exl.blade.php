@extends('layouts.pdf')

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')

    <?php
    $transaction = new \App\Transaction();
    ?>

    <div class="mid">
        @foreach($transaction_income_expense_head_ids_names as $transaction_income_expense_head_id_name)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                    <table>
                        <tr>
                            <th valign="middle" colspan="10">
                                <b>{{ $transaction_income_expense_head_id_name->income_expense_head_name }}</b></th>
                        </tr>
                    </table>

                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col"><b>SL. No</b></th>
                            <th scope="col"><b>Date</b></th>
                            <th scope="col"><b>Project Name</b></th>
                            <th scope="col"><b>Mode Of Payment</b></th>
                            <th scope="col"><b>Cheque Number</b></th>
                            <th scope="col"><b>Particulars</b></th>
                            <th scope="col"><b>Voucher No</b></th>
                            <th scope="col"><b>Type Of Voucher</b></th>
                            <th class="text-right" scope="col"><b>Debit
                                    ( <?php echo (config('settings.is_code') == 'code') ?
                                        config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                                </b>
                            </th>
                            <th class="text-right" scope="col">
                                <b>Credit( <?php echo (config('settings.is_code') == 'code') ?
                                        config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                                </b>
                            </th>
                            <th class="text-right" scope="col"><b> Balance
                                    ( <?php echo (config('settings.is_code') == 'code') ?
                                        config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                                </b>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $index = 1;
                        $balance = 0;
                        ?>
                        @foreach($items as $item)
                            @if($transaction_income_expense_head_id_name->income_expense_head_id != $item->income_expense_head_id or $item->income_expense_head_id ==null )
                                @continue;
                            @endif
                            @if($transaction_income_expense_head_id_name->type)  {{--Dr 1 Cr 0--}}
                            <?php  $balance += $item->dr - $item->cr ?>   {{--Dr=Dr-Cr--}}
                            @else
                                <?php  $balance += $item->dr - $item->cr ?>   {{--Cr=Cr-Dr--}}
                            @endif
                            <?php $branch_name = null; ?>
                            <?php $bank_cash_name = null; ?>
                            @if(isset($item->bank_cash_id))
                                <?php $bank_cash_name = App\Transaction::find($item->id)->BankCash->name ?>
                            @endif
                            @if(isset($item->branch_id))
                                <?php $branch_name = App\Transaction::find($item->id)->Branch->name ?>
                            @endif
                            <tr>
                                <th class="text-center" scope="row">{{ $index }}</th>
                                <td>{{ date(config('settings.date_format'), strtotime($item->voucher_date))   }}</td>
                                <td> {{ $branch_name }} </td>
                                <td> {{ $bank_cash_name  }} </td>
                                <td> {{ $item->cheque_number  }} </td>

                                <td> {{ $item->particulars  }} </td>
                                <td class="text-center"> {{ $item->voucher_no  }} </td>
                                <td> {{ $item->voucher_type  }} </td>
                                <td class="text-right">{{  $item->dr }}</td>
                                <td class="text-right">{{  $item->cr }}</td>
                                <td class="text-right">{{  $balance }}</td>
                            </tr>
                            <?php $index++;
                            ?>
                        @endforeach
                        <tr>
                            <th class="text-right" colspan="10"><b>Balance =</b></th>
                            <th class="text-right">{{  $balance }}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@stop


