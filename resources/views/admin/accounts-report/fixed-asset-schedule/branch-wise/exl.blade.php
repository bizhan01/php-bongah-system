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
                        <th colspan="10">{{ $extra['voucher_type']  }}</th>
                    </tr>

                    <tr>
                        <th>
                            <h5>Particulars </h5>
                        </th>
                        <th>
                            <h5>
                                Opening Balance ( {{ $search_by['from'] }} )

                                <?php echo (config('settings.is_code') == 'code') ?
                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                            </h5>
                        </th>
                        <th >
                            <h5>Addition During Year</h5>
                        </th>
                        <th>
                            <h5>Deduction During Year</h5>
                        </th>
                        <th >
                            <h5>Total Assets</h5>
                        </th>
                        <th >
                            <h5>Dep.Rate (%)</h5>
                        </th>
                        <th >
                            <h5>Accumulated Depreciation</h5>
                        </th>
                        <th >
                            <h5>Current Year Depreciation</h5>
                        </th>
                        <th >
                            <h5>Total Depreciation</h5>
                        </th>
                        <th >
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
                            <td  scope="row">{{ $particular  }}</td>
                            <td  scope="row">{{  $balance   }}</td>
                            <td  scope="row">0</td>
                            <td  scope="row">0</td>
                            <td  scope="row">0</td>
                            <td  scope="row">0</td>
                            <td  scope="row">0</td>
                            <td  scope="row">0</td>
                            <td  scope="row">0</td>

                            <td scope="row">
                                {{  $particulars['EndDate'][$particular]   }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td  scope="row">Total=</td>
                        <td  scope="row">
                            {{ $particulars['TotalBalance']['start_balance']   }}
                        </td>
                        <td  scope="row">0</td>
                        <td  scope="row">0</td>
                        <td  scope="row">0</td>
                        <td  scope="row">0</td>
                        <td  scope="row">0</td>
                        <td  scope="row">0</td>
                        <td  scope="row">0</td>

                        <td  scope="row">
                            {{  $particulars['TotalBalance']['end_balance']   }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

@stop
