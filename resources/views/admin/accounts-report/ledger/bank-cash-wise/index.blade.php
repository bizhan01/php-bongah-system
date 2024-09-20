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
                        <td class="text-right">Bank Cash Name:</td>
                        <th>{{ $search_by['bank_cash_name']  }}</th>
                        <td class="text-right">Branch Name:</td>
                        <th>{{ $search_by['branch_name']  }}</th>
                        <td class="text-right">From Date:</td>
                        <th>{{ $search_by['from'] }}</th>
                        <td class="text-right">To Date:</td>
                        <th>{{ $search_by['to'] }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="mid">
        @foreach($transaction_bank_cash_views as $transaction_bank_cash_view)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                    <h4 class="text-center mb-3">{{ $transaction_bank_cash_view->name }}</h4>
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">SL. No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Project Name</th>
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
                        $dr_balance = 0;
                        $cr_balance = 0;
                        ?>
                        @foreach($items as $item)
                            @if($transaction_bank_cash_view->bank_cash_id != $item->bank_cash_id or $item->bank_cash_id ==null )
                                @continue;
                            @endif

                            <?php $branch_name = null; ?>
                            @if(isset($item->branch_id))
                                <?php $branch_name = App\Transaction::find($item->id)->Branch->name ?>
                            @endif

                            <tr>
                                <th class="text-center" scope="row">{{ $index }}</th>
                                <td>{{ date(config('settings.date_format'), strtotime($item->voucher_date))   }}</td>
                                <td> {{ $branch_name }} </td>
                                <td> {{ $item->cheque_number  }} </td>
                                <td> {{ $item->particulars  }} </td>
                                <td class="text-center"> {{ $item->voucher_no  }} </td>
                                <td> {{ $item->voucher_type  }} </td>
                                <td class="text-right">{{  $transaction->convert_money_format($item->dr) }}</td>
                                <td class="text-right">{{  $transaction->convert_money_format($item->cr) }}</td>

                            </tr>
                            <?php $index++;
                            $dr_balance +=$item->dr;
                            $cr_balance +=$item->cr;
                            ?>
                        @endforeach
                        <tr>
                            <th class="text-right" colspan="7">Total =</th>
                            <th class="text-right">{{  $transaction->convert_money_format($dr_balance) }}</th>
                            <th class="text-right">{{  $transaction->convert_money_format($cr_balance) }}</th>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="7">Balance =</th>
                            <th class="text-left" colspan="2">{{  $transaction->convert_money_format($cr_balance-$dr_balance) }}</th>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@stop


