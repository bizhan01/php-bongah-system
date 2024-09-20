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
                       <th colspan="3">{{ $extra['voucher_type'] }}</th>
                    </tr>
                    <tr>
                        <th>
                            Sl.No
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Code
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
                            <td>{{ $item->name  }}</td>
                            <td>{{ $item->code  }}</td>
                        </tr>
                        <?php $sl++; ?>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>


    </div>

@stop


