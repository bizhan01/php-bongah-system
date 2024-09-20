@extends('layouts.pdf')

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')

    <?php
    $transaction = new \App\Transaction();
    ?>

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
                            <th colspan="4" class="text-center font-s-18">
                                {{ $branch->name  }}
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" scope="col"><b>Sl. No</b></th>
                            <th scope="col"><b>Head Of Account</b></th>
                            <th class="text-right" scope="col"><b>Dr
                                    ( <?php echo (config('settings.is_code') == 'code') ?
                                        config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                                </b>
                            </th>
                            <th class="text-right" scope="col"><b>Cr
                                    ( <?php echo (config('settings.is_code') == 'code') ?
                                        config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                                </b>
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
                                        <?php $sub_dr += $dr = $transaction->GetBalanceByBranchIdIncExpIdTypeId($branch->branch_id, $item->income_expense_head_id, $item->type, $search_by['from'], $search_by['to']) ?>
                                        {{   $dr  }}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if($item->type==0)
                                        <?php $sub_cr += $cr = $transaction->GetBalanceByBranchIdIncExpIdTypeId($branch->branch_id, $item->income_expense_head_id, $item->type, $search_by['from'], $search_by['to']) ?>
                                        {{  $cr }}
                                    @else
                                        0
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        <?php $total_dr += $sub_dr ?>
                        <?php $total_cr += $sub_cr ?>
                        <tr>
                            <th class="text-right font-w-b font-s-16" colspan="2"> Sub Total =</th>
                            <th class="text-right font-w-b font-s-16">{{  $sub_dr }}</th>
                            <th class="text-right font-w-b font-s-16">{{  $sub_cr }}</th>
                        </tr>

                        @if (count($items['branches'])==$branch_number)
                            <tr>
                                <th class="text-right font-s-20" colspan="2">Total Amount=</th>
                                <th
                                        class="text-right font-s-20">{{  $total_dr }}</th>
                                <th
                                        class="text-right font-s-20">{{  $total_cr }}</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
            <?php $branch_number++; ?>
        @endforeach
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                    <tr>
                        <th colspan="4" class="text-center font-s-18">
                            Closing Bank &amp; Cash Balance
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"><b>Sl. No</b></th>
                        <th scope="col"></th>
                        <th class="text-right" scope="col"><b>Dr ( <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                            </b>
                        </th>
                        <th class="text-right" scope="col"><b>Cr ( <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?> )
                            </b>
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
                                {{ $sub_bank_cash_balance }}

                            </td>
                            <td class="text-right">
                                0
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <th class="text-right font-w-b font-s-16" colspan="2">Sub Total =</th>
                        <th class="text-right font-w-b font-s-16">{{  $total_bank_cash_balance }}</th>
                        <th class="text-right font-w-b font-s-16">{{  0 }}</th>
                    </tr>

                    <tr>
                        <th class="text-right font-w-b font-s-20" colspan="2">Grand Total Amount =</th>
                        <th
                                class="text-right font-w-b font-s-20">{{  $total_cr }}</th>
                        <th
                                class="text-right font-w-b font-s-20">{{ $total_dr+$total_bank_cash_balance }}</th>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
