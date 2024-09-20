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
                        <th  class="text-right"
                            scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                        </th>
                        <th class="text-right"
                            scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($particulars as $key=>$particular)
                        <tr>

                            <td @if ($key=='Revenue' or $key=='GrossProfit'
                         or $key=='IncomeFromOperation' or $key=='IncomeBeforeTaxAndInterest'
                         or $key=='IncomeAfterTaxAndInterest'
                         )

                                @elseif ($key=='NetProfitOrLoss')

                                @endif class="text-left" scope="row">{{ $particular['name']  }}</td>


                            <td @if ($key=='Revenue' or $key=='GrossProfit'
                         or $key=='IncomeFromOperation' or $key=='IncomeBeforeTaxAndInterest'
                         or $key=='IncomeAfterTaxAndInterest'
                         )

                                @elseif ($key=='NetProfitOrLoss')

                                @endif scope="row"
                                class=" text-right">{{ $particular['balance']['start_balance']  }} </td>

                            <td @if ($key=='Revenue' or $key=='GrossProfit'
                         or $key=='IncomeFromOperation' or $key=='IncomeBeforeTaxAndInterest'
                         or $key=='IncomeAfterTaxAndInterest'
                         )

                                @elseif ($key=='NetProfitOrLoss')

                                @endif class="text-right">{{ $particular['balance']['end_balance']  }} </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

@stop
