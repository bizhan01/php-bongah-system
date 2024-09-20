@extends('layouts.pdf')

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')

    <?php
    $transaction = new \App\Transaction();
    ?>

    <div class="mid">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>

                    <tr>
                        <th colspan="3">{{ $extra['voucher_type']  }}</th>
                    </tr>

                    <tr>
                        <th>
                            <h5>Particulars </h5>
                        </th>
                        <th>
                            <h5>From {{ $search_by['start_from'] }} To {{ $search_by['start_to'] }}</h5>
                        </th>
                        <th>
                            <h5>From {{ $search_by['end_from'] }} To {{ $search_by['end_to'] }}</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"></th>
                        <th scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                        </th>
                        <th scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>


                    <tr>
                        <td colspan="3">A. Cash flow from Operating actives:</td>
                    </tr>


                    <tr>
                        <td>
                            {{ $particulars['ProfitLossForTheYear']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['ProfitLossForTheYear']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['ProfitLossForTheYear']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">Adjustment for:</td>
                    </tr>



                    <tr>
                        <td>
                            {{ $particulars['Depreciation']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['Depreciation']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['Depreciation']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3"><b>(Increase)/Decrease in Current Assets:</b> </td>
                    </tr>


                    <tr>
                        <td>
                            {{ $particulars['AdvanceDepositAndReceivable']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['AdvanceDepositAndReceivable']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['AdvanceDepositAndReceivable']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['Inventories']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['Inventories']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['Inventories']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['PreliminaryExpense']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['PreliminaryExpense']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['PreliminaryExpense']['balance']['end_balance']  }}
                        </td>
                    </tr>


                    <tr>
                        <td colspan="3"><b>Increse/(Decrease) in Current Liabilities:</b> </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AccountPayable']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['AccountPayable']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['AccountPayable']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['ShortTermLoan']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['ShortTermLoan']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['ShortTermLoan']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AdvanceAgainstSales']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['AdvanceAgainstSales']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['AdvanceAgainstSales']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['OtherPayable']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['OtherPayable']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['OtherPayable']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AdvanceReceiveFromInvestor']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['AdvanceReceiveFromInvestor']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['AdvanceReceiveFromInvestor']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['NetCashUsedInOperatingActives']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['NetCashUsedInOperatingActives']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['NetCashUsedInOperatingActives']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">B. Cash flow from Investing actives: (Increase) / Decrease</td>
                    </tr>


                    <tr>
                        <td>
                            {{ $particulars['AcquisitionOfPropertyPlantAndEquipment']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['AcquisitionOfPropertyPlantAndEquipment']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['AcquisitionOfPropertyPlantAndEquipment']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['NetCashUsedInInvestingActives']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['NetCashUsedInInvestingActives']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['NetCashUsedInInvestingActives']['balance']['end_balance']  }}
                        </td>
                    </tr>


                    <tr>
                        <td colspan="3">C. Cash flow from Financing actives: Increase / (Decrease)</td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['PaidUpCapital']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['PaidUpCapital']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['PaidUpCapital']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['ShareMoneyDeposit']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['ShareMoneyDeposit']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['ShareMoneyDeposit']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['LongTermLoan']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['LongTermLoan']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['LongTermLoan']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['NetCashUsedInFinanceActives']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['NetCashUsedInFinanceActives']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['NetCashUsedInFinanceActives']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['TotalActivitiesABC']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['TotalActivitiesABC']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['TotalActivitiesABC']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['OpeningCashAndBank']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['OpeningCashAndBank']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['OpeningCashAndBank']['balance']['end_balance']  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['ClosingCashAndBankBalanceDE']['name'] }}
                        </td>
                        <td>
                            {{ $particulars['ClosingCashAndBankBalanceDE']['balance']['start_balance']  }}
                        </td>
                        <td>
                            {{ $particulars['ClosingCashAndBankBalanceDE']['balance']['end_balance']  }}
                        </td>
                    </tr>


                    </tbody>
                </table>


            </div>
        </div>
        <br>
    </div>

@stop


