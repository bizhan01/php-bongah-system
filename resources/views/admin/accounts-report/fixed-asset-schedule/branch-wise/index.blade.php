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
                            <h5>
                                Opening Balance ( {{ $search_by['from'] }} )

                                <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            </h5>
                        </th>
                        <th class="text-center">
                            <h5>Addition During Year</h5>
                        </th>
                        <th class="text-center">
                            <h5>Deduction During Year</h5>
                        </th>
                        <th class="text-center">
                            <h5>Total Assets</h5>
                        </th>
                        <th class="text-center">
                            <h5>Dep.Rate (%)</h5>
                        </th>
                        <th class="text-center">
                            <h5>Accumulated Depreciation</h5>
                        </th>
                        <th class="text-center">
                            <h5>Current Year Depreciation</h5>
                        </th>
                        <th class="text-center">
                            <h5>Total Depreciation</h5>
                        </th>
                        <th class="text-center font-s-16">
                            <h5>Closing Balance ( {{  $search_by['to'] }} )

                                <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            </h5>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($particulars['StartDate'] as $particular=>$balance)
                        <tr>
                            <td class="text-left" scope="row">{{ $particular  }}</td>
                            <td class="text-right"
                                scope="row">{{ $transaction->convert_money_format( $balance )  }}</td>
                            <td class="text-center" scope="row">0</td>
                            <td class="text-center" scope="row">0</td>
                            <td class="text-center" scope="row">0</td>
                            <td class="text-center" scope="row">0</td>
                            <td class="text-center" scope="row">0</td>
                            <td class="text-center" scope="row">0</td>
                            <td class="text-center" scope="row">0</td>

                            <td class="text-right" scope="row">
                                {{ $transaction->convert_money_format( $particulars['EndDate'][$particular] )  }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right font-w-b font-s-20" scope="row">Total=</td>
                        <td class="text-right font-w-b font-s-20"
                            scope="row">{{ $transaction->convert_money_format( $particulars['TotalBalance']['start_balance'] )  }}</td>
                        <td class="text-left font-w-b font-s-20" colspan="7" scope="row"></td>
                        <td class="text-right font-w-b font-s-20" scope="row">
                            {{ $transaction->convert_money_format( $particulars['TotalBalance']['end_balance']  )  }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

@stop


