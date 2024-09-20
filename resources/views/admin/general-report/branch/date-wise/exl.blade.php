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
                        <th>
                            Sl.No
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Location
                        </th>
                        <th>
                            Description
                        </th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    $sl = 1;
                    ?>

                    @foreach($items as $item)
                        <tr>
                            <td >{{ $sl }}</td>
                            <td>{{ $item->name  }}</td>
                            <td>{{ $item->location  }}</td>
                            <td>{{ $item->description  }}</td>
                        </tr>
                        <?php $sl++; ?>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>


    </div>

@stop


