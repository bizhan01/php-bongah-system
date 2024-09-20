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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <br>
                <h2 class="text-center">{{ config('settings.company_name')  }}</h2>
                <h6 class="text-center">{{ config('settings.address_1')  }}</h6>
                <br>
                <h4 class="text-center">{{ $extra['voucher_type']  }}</h4>
                <hr>
            </div>
        </div>

    </div>

    <div class="mid">

        @foreach($branches as $branch)
            <table class="table  table-bordered table-sm">
                <thead>
                <tr>
                    <th colspan="8" class="text-center">
                        <h4>{{ App\Branch::find($branch)->name }}</h4>
                    </th>
                </tr>
                <tr>
                    <th>#</th>
                    <th scope="col">Purchase Id</th>
                    <th scope="col">Requisition Id</th>
                    <th scope="col">Vendor Id</th>
                    <th scope="col">Media Name</th>
                    <th scope="col">Issuing Date</th>
                    <th scope="col">Date of Delevery</th>

                    <th scope="col" class="text-center">Details</th>
                </tr>
                </thead>
                <tbody>
                <?php $index = 1; ?>
                @foreach($infos as $info)
                    @if ($info->branch_id == $branch)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $info->purchase_id  }}</td>
                            <td>{{ $info->requisition_id  }}</td>
                            <td>{{ App\Vendor::find( $info->vendor_id)->name  }}</td>
                            <td>{{ $info->media_name  }}</td>
                            <td>{{ $transaction->date_format( $info->issuing_date)  }}</td>
                            <td>{{ $transaction->date_format( $info->date_of_delevery )  }}</td>

                            <td>
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Items</th>
                                        <th>Qnt</th>
                                        <th>Rate</th>
                                        <th>Total ( {{ $transaction->get_currency_code() }} )</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($info->formatedItem as $item)
                                        <tr>
                                            <td>{{ $item->income_expense_head_name }}</td>
                                            <td>{{ $item->qntity }}</td>
                                            <td>{{ $transaction->convert_money_format( $item->rate) }}</td>
                                            <td>{{$transaction->convert_money_format( $item->amount ) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="3">Total Amount =</th>
                                        <th> {{ $transaction->convert_money_format($info->totalAmount) }}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php $index++; ?>
                    @endif

                @endforeach
                </tbody>
            </table>
        @endforeach


    </div>

@stop