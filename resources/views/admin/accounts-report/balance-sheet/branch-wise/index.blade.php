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
                        <td colspan="3"><h4>{{ $particulars['CapitalAndLiabilities']['name']  }}</h4></td>
                    </tr>


                    <tr>
                        <td>
                            <b>{{ $particulars['AuthorizedCapital']['name']  }} </b>
                            <p>1,00,000 Ordinary Share Of Tk. 100 each</p>
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['AuthorizedCapital']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['AuthorizedCapital']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            ISSUED, SUBSCRIBED &amp; {{ $particulars['IssuedSubscribedAndPaidUpCapital']['name']  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['IssuedSubscribedAndPaidUpCapital']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['IssuedSubscribedAndPaidUpCapital']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['RetainEarning']['name']  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['RetainEarning']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['RetainEarning']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['ShareMoneyDeposit']['name']  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['ShareMoneyDeposit']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['ShareMoneyDeposit']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['NonCurrentLiabilities']['name']  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['NonCurrentLiabilities']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['NonCurrentLiabilities']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['LongTermLoan']['name']  }}
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
                            {{ $particulars['CurrentLiabilities']['name']  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['CurrentLiabilities']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['CurrentLiabilities']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AccountPayable']['name']  }}
                        </td>
                        <td class=" text-right">
                            {{ $transaction->convert_money_format($particulars['AccountPayable']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AccountPayable']['balance']['end_balance'])  }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $particulars['ShortTermLoan']['name']  }}
                        </td>
                        <td class=" text-right">
                            {{ $transaction->convert_money_format($particulars['ShortTermLoan']['balance']['start_balance'])  }}
                        </td>
                        <td class=" text-right">
                            {{ $transaction->convert_money_format($particulars['ShortTermLoan']['balance']['end_balance'])  }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $particulars['AdvanceAgainstSales']['name']  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceAgainstSales']['balance']['start_balance'])  }}
                        </td>
                        <td class=" text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceAgainstSales']['balance']['end_balance'])  }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $particulars['OtherPayable']['name']  }}
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
                            {{ $particulars['AdvanceReceiveFromInvestor']['name']  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceReceiveFromInvestor']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceReceiveFromInvestor']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b text-right font-s-20">
                            {{ $particulars['TotalCapitalAndLiabilities']['name']  }}
                        </td>
                        <td class="font-w-b text-right font-s-20">
                            {{ $transaction->convert_money_format($particulars['TotalCapitalAndLiabilities']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right font-s-20">
                            {{ $transaction->convert_money_format($particulars['TotalCapitalAndLiabilities']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3"><h4>{{ $particulars['Assets']['name']  }}</h4></td>
                    </tr>


                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['NonCurrentAssets']['name']  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['NonCurrentAssets']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['NonCurrentAssets']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['fixedAssetsSchedule']['name']  }}
                        </td>
                        <td class=" text-right">
                            {{ $transaction->convert_money_format($particulars['fixedAssetsSchedule']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['fixedAssetsSchedule']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b">
                            {{ $particulars['CurrentAssets']['name']  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['CurrentAssets']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right">
                            {{ $transaction->convert_money_format($particulars['CurrentAssets']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ $particulars['AdvanceDepositReceivables']['name']  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceDepositReceivables']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['AdvanceDepositReceivables']['balance']['end_balance'])  }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $particulars['Inventories']['name']  }}
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
                            {{ $particulars['CashAndBankBalance']['name']  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['CashAndBankBalance']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['CashAndBankBalance']['balance']['end_balance'])  }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $particulars['PreliminaryExpense']['name']  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['PreliminaryExpense']['balance']['start_balance'])  }}
                        </td>
                        <td class="text-right">
                            {{ $transaction->convert_money_format($particulars['PreliminaryExpense']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-w-b text-right fon-s-20">
                            {{ $particulars['TotalAssets']['name']  }}
                        </td>
                        <td class="font-w-b text-right fon-s-20">
                            {{ $transaction->convert_money_format($particulars['TotalAssets']['balance']['start_balance'])  }}
                        </td>
                        <td class="font-w-b text-right fon-s-20">
                            {{ $transaction->convert_money_format( $particulars['TotalAssets']['balance']['end_balance'])  }}
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
        <br>
    </div>

@stop


