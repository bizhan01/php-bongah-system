@extends('layouts.pdf')

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')

    <?php
    $transaction = new \App\Transaction();
    ?>

    <div class="mid">
        @foreach($transaction_bank_cash_views as $transaction_bank_cash_view)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                    <table>
                        <tr>
                            <td colspan="8"><b>{{ $transaction_bank_cash_view->name }}</b></td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col"><b> SL. No</b></th>
                            <th scope="col"><b> Date</b></th>
                            <th scope="col"><b> Project Name</b></th>
                            <th scope="col"><b> Cheque Number</b></th>
                            <th scope="col"><b> Particulars</b></th>
                            <th scope="col"><b> Voucher No</b></th>
                            <th scope="col"><b> Type Of Voucher</b></th>
                            <th class="text-right" scope="col"><b> Dr ( <?php echo (config('settings.is_code') == 'code') ?
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
                                <td class="text-right">{{  $item->dr }}</td>
                                <td class="text-right">{{  $item->cr }}</td>

                            </tr>
                            <?php $index++;
                            $dr_balance +=$item->dr;
                            $cr_balance +=$item->cr;
                            ?>
                        @endforeach
                        <tr>
                            <th class="text-right" colspan="7"><b>Total =</b></th>
                            <th class="text-right"><b>{{  $dr_balance }}</b></th>
                            <th class="text-right"><b>{{  $cr_balance }}</b></th>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="7"><b> Balance =</b></th>
                            <th class="text-left" colspan="2"><b>{{  $cr_balance-$dr_balance }}</b></th>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@stop


