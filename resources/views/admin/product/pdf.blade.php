<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <!-- Bootstrap Core Css -->
    <link href="{{ asset('asset/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    {{--pdf style--}}
    <link rel="stylesheet" href="{{ asset('asset/css/pdf.css') }}">


    <title>{{ $extra['module_name']  }}</title>
</head>
<body>

<?php
$transaction = new \App\Transaction();
$curency_symble=$transaction->get_currency_code();
?>

<section class="content">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="bb-1 margin-bottom-10">
            <div class="header">
                <p>{{ $extra['current_date_time']  }}</p>
                <h1 class="text-center"><?php echo Config::get('settings.company_name'); ?></h1>
                <p class="text-center"><?php echo Config::get('settings.address_1'); ?></p>
            </div>
        </div>
        <div class="module_name">
            <p>Module Name : {{ $extra['module_name']  }}</p>
        </div>
        <div class="card">
            <div class="header">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Product Unique ID</td>
                                    <td>{{ $items->product_unique_id }}</td>
                                </tr>
                                <tr>
                                    <td>Project Name</td>
                                    <td>{{ App\Product::find($items->id)->branch->name }}</td>
                                </tr>

                                <tr>
                                    <td>Flat Type</td>
                                    <td>{{ $items->flat_type }}</td>
                                </tr>
                                <tr>
                                    <td>Floor Number</td>
                                    <td>{{ $items->floor_number }}</td>
                                </tr>

                                <tr>
                                    <td>Flat Size</td>
                                    <td>{{ $items->flat_size }}</td>
                                </tr>

                                <tr>
                                    <td>Unite Price ( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->unite_price) }}</td>
                                </tr>

                                <tr class="text-bold">
                                    <td>Total Flat Price( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->total_flat_price) }}</td>
                                </tr>

                                <tr>
                                    <td>Car Parking Charge( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->car_parking_charge) }}</td>
                                </tr>

                                <tr>
                                    <td>Utility Charge( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->utility_charge) }}</td>
                                </tr>

                                <tr>
                                    <td>Additional Work Charge( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->additional_work_charge) }}</td>
                                </tr>

                                <tr>
                                    <td>Other Charge( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->other_charge) }}</td>
                                </tr>

                                <tr>
                                    <td>Discount Or Deduction( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->discount_or_deduction) }}</td>
                                </tr>

                                <tr>
                                    <td>Refund Additional Work Charge( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->refund_additional_work_charge) }}</td>
                                </tr>

                                <tr class="text-bold">
                                    <td>Net Sells Price( {{ $curency_symble }} ) </td>
                                    <td>{{ $transaction->convert_money_format($items->net_sells_price) }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $items->description }}</td>
                                </tr>

                                <tr>
                                    <td>Product Image</td>
                                    <td><img width="50" height="50" src="{{ asset($items->product_img) }}" alt=""></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Inline Layout | With Floating Label -->
</section>

</body>
</html>

