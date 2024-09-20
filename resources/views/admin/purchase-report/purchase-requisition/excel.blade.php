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

        @foreach($branches as $branch)
            <table class="table  table-bordered table-sm">
                <thead>
                <tr>
                    <th colspan="7" class="text-center">
                        <h4><b>{{ App\Branch::find($branch)->name }}</b></h4>
                    </th>
                </tr>
                <tr>
                    <th>#</th>
                    <th scope="col"><b>Requisition Date</b></th>
                    <th scope="col"><b>Required Date</b></th>
                    <th scope="col"><b>Requisition Id</b></th>
                    <th scope="col"><b>Requisitor Name</b></th>
                    <th scope="col"><b>Contract Person</b></th>

                    <th scope="col" class="text-center"><b>Details</b></th>
                </tr>
                </thead>
                <tbody>
                <?php $index = 1; ?>
                @foreach($infos as $info)
                    @if ($info->branch_id == $branch)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $transaction->date_format($info->requisition_date)  }}</td>
                            <td>{{ $transaction->date_format($info->required_date) }}</td>
                            <td>{{ $info->requisition_id }}</td>
                            <td>{{ App\Employee::find($info->employee_id)->name }}</td>
                            <td>{{ $info->contract_person }}</td>
                            <td>
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th><b>Items</b></th>
                                        <th><b>Qnt</b></th>
                                        <th><b>Rate</b></th>
                                        <th><b>Total ( {{ $transaction->get_currency_code() }} )</b></th>
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
                                        <th> {{ $transaction->convert_money_format($info->amount) }}</th>
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