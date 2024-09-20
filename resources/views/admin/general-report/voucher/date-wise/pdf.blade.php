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
                        <td class="text-right">Voucher Type</td>
                        <th>{{ $search_by['type_name'] }}</th>
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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                <table class="table table-bordered table-sm table-hover">
                    <thead>

                    <tr>
                        <th class="text-center">
                            Sl.No
                        </th>
                        <th class="text-center">Voucher No</th>
                        <th class="text-center">Type</th>
                        <th>Particulars</th>
                        <th>Branch Name</th>
                        <th>Date</th>
                        <th>Ledger Name</th>
                        <th>Made Of Payment</th>
                        <th>CHQ. No</th>

                        <th>Debit ( <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            )
                        </th>

                        <th>Credit ( <?php echo (config('settings.is_code') == 'code') ?
                                config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            )
                        </th>


                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    $sl = 1;
                    ?>

                    @foreach($items as $item)
                        <tr>
                            <td class="text-center">{{ $sl }}</td>

                            <td class="text-center">{{ str_pad($item->voucher_no, 4, '0', STR_PAD_LEFT)  }}</td>
                            <td>{{ $item->voucher_type }}</td>
                            <td>{{ $item->particulars }}</td>
                            <td>{{ App\Transaction::find($item->id)->Branch->name }}</td>
                            <td>{{ date(config('settings.date_format'), strtotime($item->voucher_date)) }}</td>

                            <td>
                                @if( !empty(App\Transaction::find($item->id)->IncomeExpenseHead->name) )
                                    {{ App\Transaction::find($item->id)->IncomeExpenseHead->name  }}
                                @endif
                            </td>

                            <td>
                                @if( !empty(App\Transaction::find($item->id)->BankCash->name) )
                                    {{ App\Transaction::find($item->id)->BankCash->name }}
                                @endif

                            </td>


                            <td> {{ $item->cheque_number }} </td>
                            <td>{{ $transaction->convert_money_format($item->dr) }}</td>
                            <td>{{ $transaction->convert_money_format($item->cr) }}</td>


                        </tr>
                        <?php $sl++; ?>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>


    </div>

@stop


