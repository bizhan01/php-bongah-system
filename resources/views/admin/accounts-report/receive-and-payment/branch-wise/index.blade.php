@extends('layouts.pdf')

@push('include-css')
    <link rel="stylesheet" href="{{ asset('asset/css/main-report.css') }}">
@endpush

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')

    <?php
    $transaction=new \App\Transaction();
    $ReceivePaymentController = new \App\Http\Controllers\Reports\Accounts\ReceivePaymentController();
    ?>


    <div class="mid">
        <h2 class="text-center">{{ config('settings.company_name')  }}</h2>
        <h5 class="text-center ">{{ config('settings.address_1')  }}</h5>
        <hr>
        <h4 class="text-center mb-4">{{ $extra['voucher_type']  }}</h4>
    </div>

    <div class="mid">
        <?php $total_dr = 0; ?>
        <?php $total_cr = 0;
        $branch_number = 1;
        ?>

        @foreach($items['branches'] as $branch)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr>
                            <th colspan="5" class="text-center font-s-25">
                                {{ $branch->name  }}
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                Sl. No
                            </th>
                            <th class="text-center font-s-18">
                                Head Of Account
                            </th>
                            <th class="text-center font-s-18" colspan="2">
                                @if ( !empty($search_by['from']) )
                                    From {{ date(config('settings.date_format'), strtotime($search_by['from']))  }} to {{ date(config('settings.date_format'), strtotime($search_by['to'])) }}
                                @else
                                    UpTo to {{ $extra['current_date_time'] }}
                                @endif

                            </th>
                        </tr>

                        <tr>
                            <th class="text-center" scope="col"></th>
                            <th scope="col"></th>
                            <th class="text-right" scope="col">Dr ( <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                            </th>
                            <th class="text-right" scope="col">Cr ( <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $sub_dr = 0; ?>
                        <?php $sub_cr = 0; ?>

                        @foreach($items['UniqueIncExpHeadDetails'][$branch->branch_id] as $key=>$item)

                            <tr>
                                <th class="text-center" scope="row">{{ $key+1  }}</th>
                                <td scope="row">{{ $item->name }}</td>
                                <td class="text-right">
                                    @if($item->type==1)
                                        <?php $sub_dr += $dr = $ReceivePaymentController->GetReceivePaymentByBranchIdIncExpIdTypeId($branch->branch_id, $item->income_expense_head_id, $item->type , $search_by['from'], $search_by['to']) ?>
                                        {{  $transaction->convert_money_format( $dr ) }}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if($item->type==0)
                                        <?php $sub_cr += $cr = $ReceivePaymentController->GetReceivePaymentByBranchIdIncExpIdTypeId($branch->branch_id, $item->income_expense_head_id, $item->type , $search_by['from'], $search_by['to'] ) ?>
                                        {{  $transaction->convert_money_format($cr) }}
                                    @else
                                        0
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <?php $total_dr += $sub_dr ?>
                        <?php $total_cr += $sub_cr ?>
                        <tr>
                            <th class="text-right" colspan="2">Sub Total =</th>
                            <th class="text-right">{{  $transaction->convert_money_format($sub_dr) }}</th>
                            <th class="text-right">{{  $transaction->convert_money_format($sub_cr) }}</th>
                        </tr>

                        @if (count($items['branches'])==$branch_number)
                            <tr>
                                <th class="text-right font-s-20" colspan="2">Total Amount=</th>
                                <th class="text-right font-s-20">{{  $transaction->convert_money_format($total_dr) }}</th>
                                <th class="text-right font-s-20">{{  $transaction->convert_money_format($total_cr) }}</th>
                            </tr>
                        @endif


                        </tbody>
                    </table>

                </div>
            </div>
            <br>
            <?php $branch_number++; ?>
        @endforeach

        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">
                            Sl. No
                        </th>
                        <th class="text-center font-s-18">
                            Closing Bank & Cash Balance
                        </th>
                        <th class="text-center font-s-18" colspan="2">

                            @if ( !empty($search_by['from']) )
                                From {{ date(config('settings.date_format'), strtotime($search_by['from']))  }} to {{ date(config('settings.date_format'), strtotime($search_by['to'])) }}
                            @else
                                UpTo to {{ $extra['current_date_time'] }}
                            @endif

                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"></th>
                        <th scope="col"></th>
                        <th class="text-right" scope="col">Dr ( <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                        </th>
                        <th class="text-right" scope="col">Cr ( <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $total_bank_cash_balance = 0; ?>

                    @foreach($items['bank_cashes'] as $key=>$item)

                        <tr>
                            <th class="text-center" scope="row">{{ $key+1  }}</th>
                            <td scope="row">{{ $item->name }}</td>
                            <td class="text-right">
                                <?php $total_bank_cash_balance += $sub_bank_cash_balance = $items['bank_cash_balance'][$item->bank_cash_id] ?>
                                {{ $transaction->convert_money_format($sub_bank_cash_balance) }}

                            </td>
                            <td class="text-right">
                                0
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th class="text-right" colspan="2">Sub Total =</th>
                        <th class="text-right">{{  $transaction->convert_money_format($total_bank_cash_balance) }}</th>
                        <th class="text-right">{{  $transaction->convert_money_format(0) }}</th>
                    </tr>

                    <tr>
                        <th  class="text-right font-s-20" colspan="2">Grand Total Amount =</th>
                        <th  class="text-right font-s-20">{{  $transaction->convert_money_format($total_cr) }}</th>
                        <th  class="text-right font-s-20">{{  $transaction->convert_money_format($total_dr+$total_bank_cash_balance) }}</th>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

@stop


