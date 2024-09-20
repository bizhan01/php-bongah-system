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
        <h2 class="text-center">{{ config('settings.company_name')  }}</h2>
        <h5 class="text-center ">{{ config('settings.address_1')  }}</h5>
        <hr>
        <h4 class="text-center mb-4">{{ $extra['voucher_type']  }}</h4>
    </div>

    <div class="mid mb-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <td class="text-right">Search By:</td>
                        <td class="text-right">Ledger Type</td>
                        <th class="text-left">{{ $search_by['income_expense_type_name']  }}</th>
                        <td class="text-right">Project Name:</td>
                        <th>{{ $search_by['branch_name']  }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div class="mid">

        <div class="row">

            <?php $slNo = 0; ?>

            <?php $TotalStartBalance = 0; ?>
            <?php $TotalEndBalance = 0; ?>

            @foreach($particulars as $type_name=>$particular)

                <?php $slNo++; ?>

                @if($particular['headDetails']['TotalBalance']['start_balance']==0  and $particular['headDetails']['TotalBalance']['end_balance']==0  )
                    @continue
                @endif


                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 mb-5">
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr>
                            <th class="text-center padding-t-8" colspan="3"><h3>{{ $type_name  }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">

                            </th>
                            <th class="text-center">
                                <h5>From {{ $search_by['start_from'] }} To {{ $search_by['start_to'] }}</h5>
                            </th>
                            <th class="text-center">
                                <h5>From {{ $search_by['end_from'] }} To {{ $search_by['end_to'] }}</h5>
                            </th>

                        </tr>
                        <tr>
                            <th class="text-left" scope="col">Ledger Name</th>
                            <th class="text-right" scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            </th>
                            <th class="text-right" scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($particular['headDetails']['StartDate'] as $ledger_name=>$ledger_balance)

                            @if($ledger_balance==0 and $particular['headDetails']['EndDate'][$ledger_name]==0)
                                @continue
                            @endif


                            <tr>
                                <td class="text-left" scope="row">{{ $ledger_name  }}</td>
                                <td scope="row" class=" text-right">{{ $transaction->convert_money_format( $ledger_balance)  }}</td>
                                <td class="text-right">{{ $transaction->convert_money_format( $particular['headDetails']['EndDate'][$ledger_name]) }}</td>
                            </tr>

                        @endforeach

                        <tr>
                            <th class="text-right"> Sub Total =</th>
                            <th class="text-right">{{ $transaction->convert_money_format( $particular['balance']['start_balance']) }}</th>
                            <th class="text-right">{{ $transaction->convert_money_format( $particular['balance']['end_balance']) }}</th>
                        </tr>

                        <?php

                        $TotalStartBalance += $particular['balance']['start_balance'];
                        $TotalEndBalance += $particular['balance']['end_balance'];

                        ?>


                        </tbody>
                    </table>
                </div>

            @endforeach

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-right" ><h2>Grand Total = </h2></th>
                    <th class="text-right"><h2>{{ $transaction->convert_money_format( $TotalStartBalance) }} </h2></th>
                    <th class="text-right"><h2>{{ $transaction->convert_money_format( $TotalEndBalance)  }} </h2></th>
                </tr>
                </thead>
            </table>


        </div>
        <br>
    </div>

@stop


