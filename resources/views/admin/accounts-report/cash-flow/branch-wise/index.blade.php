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
                        <th class="text-center">
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
                        <td colspan="3"><h4>A. Cash flow from Operating actives:</h4></td>
                    </tr>


                    <tr>
                        <td>
                            {{ $particulars['ProfitLossForTheYear']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['ProfitLossForTheYear']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['ProfitLossForTheYear']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">Adjustment for:</td>
                    </tr>



                    <tr>
                        <td>
                            {{ $particulars['Depreciation']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['Depreciation']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['Depreciation']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3"><b>(Increse)/Decrease in Current Assets:</b> </td>
                    </tr>


                    <tr>
                        <td>
                            {{ $particulars['AdvanceDepositAndReceivable']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceDepositAndReceivable']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceDepositAndReceivable']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['Inventories']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['Inventories']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['Inventories']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['PreliminaryExpense']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['PreliminaryExpense']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['PreliminaryExpense']['balance']['end_balance'])  }}
                        </td>
                    </tr>


                    <tr>
                        <td colspan="3"><b>Increse/(Decrease) in Current Liabilites:</b> </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AccountPayable']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AccountPayable']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AccountPayable']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['ShortTermLoan']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['ShortTermLoan']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['ShortTermLoan']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AdvanceAgainstSales']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceAgainstSales']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceAgainstSales']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['OtherPayable']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['OtherPayable']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['OtherPayable']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AdvanceReceiveFromInvestor']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceReceiveFromInvestor']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceReceiveFromInvestor']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['NetCashUsedInOperatingActives']['name'] }}
                        </td>
                        <td class="text-right font-w-b" >
                            {{ $transaction->convert_money_format($particulars['NetCashUsedInOperatingActives']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right font-w-b" >
                            {{ $transaction->convert_money_format($particulars['NetCashUsedInOperatingActives']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3"><h4>B. Cash flow from Investing actives: (Increase) / Decrease</h4></td>
                    </tr>


                    <tr>
                        <td>
                            {{ $particulars['AcquisitionOfPropertyPlantAndEquipment']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AcquisitionOfPropertyPlantAndEquipment']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AcquisitionOfPropertyPlantAndEquipment']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['NetCashUsedInInvestingActives']['name'] }}
                        </td>
                        <td class="text-right font-w-b">
                            {{ $transaction->convert_money_format($particulars['NetCashUsedInInvestingActives']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right font-w-b">
                            {{ $transaction->convert_money_format($particulars['NetCashUsedInInvestingActives']['balance']['end_balance'])  }}
                        </td>
                    </tr>


                    <tr>
                        <td colspan="3"><h4>C. Cash flow from Financing actives: Increase / (Decrease)</h4></td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['PaidUpCapital']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['PaidUpCapital']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['PaidUpCapital']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['ShareMoneyDeposit']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['ShareMoneyDeposit']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['ShareMoneyDeposit']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['LongTermLoan']['name'] }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['LongTermLoan']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['LongTermLoan']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['NetCashUsedInFinanceActives']['name'] }}
                        </td>
                        <td class="text-right font-w-b" >
                            {{ $transaction->convert_money_format($particulars['NetCashUsedInFinanceActives']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right font-w-b">
                            {{ $transaction->convert_money_format($particulars['NetCashUsedInFinanceActives']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            <h4>{{ $particulars['TotalActivitiesABC']['name'] }}</h4>
                        </td>
                        <td class="text-right font-w-b">
                            <h4>{{ $transaction->convert_money_format($particulars['TotalActivitiesABC']['balance']['start_balance'])  }}</h4>
                        </td>
                        <td class="text-right font-w-b">
                            <h4>{{ $transaction->convert_money_format($particulars['TotalActivitiesABC']['balance']['end_balance'])  }}</h4>
                        </td>
                    </tr>

                    <tr>
                        <td class=" font-w-b">
                            <h4>{{ $particulars['OpeningCashAndBank']['name'] }}</h4>
                        </td>
                        <td class="text-right font-w-b">
                            <h4>{{ $transaction->convert_money_format($particulars['OpeningCashAndBank']['balance']['start_balance'])  }}</h4>
                        </td>
                        <td class="text-right font-w-b">
                            <h4>{{ $transaction->convert_money_format($particulars['OpeningCashAndBank']['balance']['end_balance'])  }}</h4>
                        </td>
                    </tr>

                    <tr>
                        <td class=" text-right" >
                            <h4>{{ $particulars['ClosingCashAndBankBalanceDE']['name'] }}</h4>
                        </td>
                        <td class="font-w-b text-right">
                            <h4>{{ $transaction->convert_money_format($particulars['ClosingCashAndBankBalanceDE']['balance']['start_balance'])  }}</h4>
                        </td>
                        <td class="font-w-b text-right">
                            <h4>{{ $transaction->convert_money_format($particulars['ClosingCashAndBankBalanceDE']['balance']['end_balance'])  }}</h4>
                        </td>
                    </tr>


                    </tbody>
                </table>


            </div>
        </div>
        <br>
    </div>

@stop


