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
                        <th colspan="11">{{ $extra['voucher_type'] }}</th>
                    </tr>

                    <tr>
                        <th>
                            Sl.No
                        </th>
                        <th>Voucher No</th>
                        <th>Type</th>
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
                            <td>{{ $sl }}</td>

                            <td class="text-center">{{ $item->voucher_no  }}</td>
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
                            <td>{{ $item->dr }}</td>
                            <td>{{ $item->cr }}</td>


                        </tr>
                        <?php $sl++; ?>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>


    </div>

@stop


