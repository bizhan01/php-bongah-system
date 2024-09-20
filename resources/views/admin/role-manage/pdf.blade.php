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


<section class="content">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="mb-1 border-b-1">
            <div class="header">
                <p>{{ $extra['current_date_time']  }}</p>

                <h1 class="text-center">{{ Config('settings.company_name')  }}</h1>
                <p class="text-center">{{ Config('settings.address_1')  }}</p>

            </div>
        </div>
        <div class="module_name">
            <p>Module Name : {{ $extra['module_name']  }}</p>
        </div>
        <div class="card">
            <div class="header">
                <h3>
                    {{  $items->name  }}
                </h3>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">S.L</th>
                                    <th scope="col" class="text-center">Module Name</th>
                                    <th scope="col" class="text-center">Module Show</th>
                                    <th scope="col" class="text-center">Show</th>
                                    <th scope="col" class="text-center">Create</th>
                                    <th scope="col" class="text-center">Edit</th>
                                    <th scope="col" class="text-center">Delete</th>
                                    <th scope="col" class="text-center">PDF</th>
                                    <th scope="col" class="text-center">Trash Show</th>
                                    <th scope="col" class="text-center">Restore</th>
                                    <th scope="col" class="text-center">Permanently Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $sl = 1; ?>
                                @foreach( $items->content as $itemKey=>$item)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $sl  }}</th>

                                        @foreach($item as $key=>$value)
                                            <td class="text-center">

                                                @if($key==0)
                                                    {{ $value }}
                                                @elseif($value==1)
                                                    On
                                                @else
                                                    Off
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    <?php $sl++; ?>
                                @endforeach
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

