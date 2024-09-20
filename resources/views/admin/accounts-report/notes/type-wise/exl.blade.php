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
                            <th colspan="3"><h3>{{ $type_name  }}</h3>
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
                            <th  class="text-left" scope="col">Ledger Name</th>
                            <th  class="text-right" scope="col"> <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            </th>
                            <th  class="text-right" scope="col"> <?php echo (config('settings.is_code') == 'code') ?
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
                                <td scope="row" class=" text-right">{{ $ledger_balance  }}</td>
                                <td class="text-right">{{ $particular['headDetails']['EndDate'][$ledger_name] }}</td>
                            </tr>

                        @endforeach

                        <tr>
                            <th> Sub Total =</th>
                            <th>{{$particular['balance']['start_balance'] }}</th>
                            <th>{{$particular['balance']['end_balance'] }}</th>
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
                    <th><h2>Grand Total = </h2></th>
                    <th><h2>{{ $TotalStartBalance }} </h2></th>
                    <th><h2>{{ $TotalEndBalance }} </h2></th>
                </tr>
                </thead>
            </table>


        </div>
        <br>
    </div>

@stop


