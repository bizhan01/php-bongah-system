@extends('layouts.pdf')

@push('include-css')
    <link rel="stylesheet" href="{{ asset('asset/css/main-report.css') }}">
@endpush

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')

    <?php
    $transaction = new \App\Transaction();
    ?>

    <div class="mid">
        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <br>
            <h2 class="text-center">{{ config('settings.company_name')  }}</h2>
            <h6 class="text-center">{{ config('settings.address_1')  }}</h6>
            <br>
            <h4 class="text-center">{{ $extra['voucher_type']  }}</h4>
            <hr>
        </div>
    </div>


    <div class="mid">
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <td class="text-right">Search By:</td>
                <td class="text-right">Branch Name:</td>
                <th>{{ $search_by['branch_name']  }}</th>
                <td class="text-right">Head Of Account:</td>
                <th>{{ $search_by['income_expense_head_name']  }}</th>
                <td class="text-right">From Date:</td>


                <th>{{ $search_by['from'] }}</th>
                <td class="text-right">To Date:</td>
                <th>{{ $search_by['to'] }}</th>
            </tr>
            </thead>
        </table>

        @foreach($branch_ids as $branch_id)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                    <h4 class="text-center mb-3">{{ App\Branch::find($branch_id)->name  }}</h4>

                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">SL. No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Head Of Account</th>
                            <th scope="col">Mode Of Payment</th>
                            <th scope="col">Cheque Number</th>
                            <th scope="col">Particulars</th>
                            <th scope="col">Voucher No</th>
                            <th scope="col">Type Of Voucher</th>
                            <th class="text-right" scope="col">Dr ( <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                            </th>
                            <th class="text-right" scope="col">Cr ( <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                            </th>
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

                                <td class="text-right">{{  $transaction->convert_money_format($item->dr) }}</td>
                                <td class="text-right">{{  $transaction->convert_money_format($item->cr) }}</td>

                            </tr>
                            <?php $index++;
                            $dr_amount += $item->dr;
                            $cr_amount += $item->cr;
                            ?>
                        @endforeach
                        <tr>
                            <th class="text-right" colspan="8">Total =</th>
                            <th class="text-right">{{  $transaction->convert_money_format($dr_amount) }}</th>
                            <th class="text-right">{{  $transaction->convert_money_format($cr_amount) }}</th>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        @endforeach
    </div>

@stop


