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

    <div class="mid mb-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <td class="text-right">Search By:</td>
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
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">
                            <h5>Particulars </h5>
                        </th>
                        <th class="text-center">
                            <h5>From {{ $search_by['start_from'] }} To {{ $search_by['start_to'] }}</h5>
                        </th>
                        <th  class="text-center font-s-18">
                            <h5>From {{ $search_by['end_from'] }} To {{ $search_by['end_to'] }}</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"></th>
                        <th class="text-right" scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                        </th>
                        <th class="text-right" scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['OpeningConstructionMaterial']  }}</td>
                        <td scope="row" class=" text-right">0</td>
                        <td class="text-right">0</td>
                    </tr>
                    <tr>
                        <td class="text-left"
                            scope="row">{{ $particulars['ConstructionMaterialPurchases']['name']  }}</td>
                        <td scope="row"
                            class=" text-right">{{ $transaction->convert_money_format( $particulars['ConstructionMaterialPurchases']['balance']['start_balance'])  }}</td>
                        <td class="text-right">{{ $transaction->convert_money_format($particulars['ConstructionMaterialPurchases']['balance']['end_balance'])  }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['MaterialAvailableForUsed']  }}</td>
                        <td scope="row" class=" text-right">{{  $transaction->convert_money_format( $particulars['ConstructionMaterialPurchases']['balance']['start_balance']) }}</td>
                        <td class="text-right"> {{  $transaction->convert_money_format( $particulars['ConstructionMaterialPurchases']['balance']['end_balance']) }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['ClosingConstructionMaterial']  }}</td>
                        <td scope="row" class=" text-right">0</td>
                        <td class="text-right">0</td>
                    </tr>
                    <tr>
                        <th class="text-left" scope="row">{{ $particulars['MaterialUsedDuringThePeriod']  }}</th>
                        <th scope="row" class=" text-right">{{  $transaction->convert_money_format( $particulars['ConstructionMaterialPurchases']['balance']['start_balance']) }}</th>
                        <th class="text-right">{{  $transaction->convert_money_format( $particulars['ConstructionMaterialPurchases']['balance']['end_balance']) }}</th>
                    </tr>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['ConstructionLabourExpense']['name']  }}</td>
                        <td scope="row"
                            class="text-right">{{ $transaction->convert_money_format($particulars['ConstructionLabourExpense']['balance']['start_balance'])  }}</td>
                        <td scope="row"
                            class="text-right">{{ $transaction->convert_money_format($particulars['ConstructionLabourExpense']['balance']['end_balance'])  }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['ProjectApprovalExpenses']['name']  }}</td>
                        <td scope="row"
                            class="text-right">{{ $transaction->convert_money_format($particulars['ProjectApprovalExpenses']['balance']['start_balance'])  }}</td>
                        <td scope="row"
                            class="text-right">{{ $transaction->convert_money_format($particulars['ProjectApprovalExpenses']['balance']['end_balance'])  }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['OtherExpense']['name']  }}</td>
                        <td scope="row"
                            class="text-right">{{ $transaction->convert_money_format($particulars['OtherExpense']['balance']['start_balance'])  }}</td>
                        <td scope="row"
                            class="text-right">{{ $transaction->convert_money_format($particulars['OtherExpense']['balance']['end_balance'])  }}</td>
                    </tr>
                    <tr>
                        <th class="text-left"
                            scope="row">{{ $particulars['TotalCostTransferredToWorkInProcess']  }}</th>
                        <th scope="row" class="text-right">{{ $transaction->convert_money_format( $particulars['ConstructionMaterialPurchases']['balance']['start_balance']+$particulars['ConstructionLabourExpense']['balance']['start_balance']+$particulars['ProjectApprovalExpenses']['balance']['start_balance'] + $particulars['OtherExpense']['balance']['start_balance'])  }}</th>
                        <th scope="row" class="text-right">{{ $transaction->convert_money_format(  $particulars['ConstructionMaterialPurchases']['balance']['end_balance']+$particulars['ConstructionLabourExpense']['balance']['end_balance']+$particulars['ProjectApprovalExpenses']['balance']['end_balance'] + $particulars['OtherExpense']['balance']['end_balance'] )  }}</th>
                    </tr>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['OpeningWorkInProcess']  }}</td>
                        <td scope="row" class="text-right">0</td>
                        <td scope="row" class="text-right">0</td>
                    </tr>
                    <tr>
                        <td class="text-left" scope="row">{{ $particulars['ClosingWorkInProcess']  }}</td>
                        <td scope="row" class="text-right">0</td>
                        <td scope="row" class="text-right">0</td>
                    </tr>
                    <tr>
                        <th class="text-left" scope="row"><h4>{{ $particulars['CostOfRevenue']  }}</h4></th>
                        <th scope="row" class="text-right"><h4>{{ $transaction->convert_money_format( $particulars['ConstructionMaterialPurchases']['balance']['start_balance']+$particulars['ConstructionLabourExpense']['balance']['start_balance']+$particulars['ProjectApprovalExpenses']['balance']['start_balance'] + $particulars['OtherExpense']['balance']['start_balance'])  }}</h4></th>
                        <th scope="row" class="text-right"><h4>{{  $transaction->convert_money_format(  $particulars['ConstructionMaterialPurchases']['balance']['end_balance']+$particulars['ConstructionLabourExpense']['balance']['end_balance']+$particulars['ProjectApprovalExpenses']['balance']['end_balance'] + $particulars['OtherExpense']['balance']['end_balance'] ) }}</h4></th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
@stop


