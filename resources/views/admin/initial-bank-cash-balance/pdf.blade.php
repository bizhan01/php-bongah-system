@extends('layouts.pdf')

@section('title')
    {{ $extra['module_name']  }}
@endsection

@push('include-css')
    <link rel="stylesheet" href="{{ asset('asset/css/only-voucher.css') }}">
@endpush

@section('content')

    <?php
    $transaction = new \App\Transaction();
    ?>
    <p>Printing Date & Time: {{ $extra['current_date_time']  }}</p>

    <div>
        <div class="f-l-W-600">
            <img class="width-60 height-60 margin-top-20"
                 src="{{ asset( config('settings.company_logo')) }}"
                 alt="">
        </div>
        <br>
        <div class="f-r width-200 margin-bottom-10">
            <p class="text-a-c border-t-1 border-l-1 border-r-1 line-h-20">
                Voucher No <br></p>
            <p class="text-a-c border-1 line-h-20">{{ str_pad($items[0]->voucher_no, 4, '0', STR_PAD_LEFT)  }}</p>
        </div>
    </div>
    <br><br><br>
    <div class="border-b-1">
        <h4 class="text-a-c font-w-b">{{ config('settings.company_name')  }}</h4>
        <h5 class="text-a-c">{{ config('settings.address_1')  }}</h5>
    </div>
    <h4 class="text-a-c margin-top-20">{{ $extra['voucher_type'] }}</h4>
    <table class="table table-bordered table-sm">
        <tbody>
        <tr>
            <td>Project Name: {{ App\Transaction::find($items[0]->id)->BankCash->name }}</td>
            <td>Date: {{  date( config('settings.date_format'), strtotime($items[0]->voucher_date))  }}</td>
        </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            <th scope="col" class="text-center">SL.No</th>
            <th scope="col">Made Of Payment</th>
            <th scope="col">CHQ.No</th>
            <th  scope="col">Amount ( <?php echo (config('settings.is_code')=='code') ?
                    config('settings.currency_code') :  config('settings.currency_symbol')  ?> )</th>

        </tr>
        </thead>
        <tbody>

        <?php $dr_total_amount = 0; ?>
        <?php $cr_total_amount = 0; ?>

        @foreach($items as $key=>$item)

            <?php
            $dr_total_amount += $item->dr;

            $cr_total_amount += $item->cr;
            ?>

            <tr>
                <th scope="row" class="text-center">{{ $key+1 }}</th>
                <td>{{ App\Transaction::find($item->id)->BankCash->name  }}</td>
                <td>{{ $item->cheque_number }}</td>
                <td>{{  $transaction->convert_money_format($item->cr) }}</td>
            </tr>
        @endforeach

        <tr>
            <th scope="row" colspan="3" class="text-right">Total =</th>
            <th>{{ $transaction->convert_money_format($cr_total_amount)  }} /=</th>
        </tr>

        </tbody>
    </table>
    <p>In word: <span class="font-w-b">{{ $transaction->convert_number_to_words($cr_total_amount) }} {!! config('settings.currency_code') !!} </span>
        only.
    </p>

    @if(!empty($items[0]->particulars))
        <br>
        <p>Particulars: <span class="font-w-b"> {{ $items[0]->particulars }}</span></p>
    @endif

    @if(count($items)==1)
        <br><br><br>
    @endif

    @if(count($items)==2)
        <br><br>
    @endif

    @if(count($items)==3)
        <br>
    @endif
    @if(count($items) >= 4)
        <br><br><br><br>
    @endif

    <table class="table">
        <tr>
            <td class="text-center border-n">
                - - - - -<br>
                Prepared by
            </td>
            <td class="text-center border-n">
                - - - - -<br>
                Checked by
            </td>
            <td class="text-center border-n">
                - - - - -<br>
                Forward by
            </td>
            <td class="text-center border-n">
                - - - - -<br>
                Approved by
            </td>
        </tr>
    </table>


@stop


