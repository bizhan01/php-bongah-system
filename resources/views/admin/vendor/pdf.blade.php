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
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Miling Address</th>
                                    <th scope="col" class="text-center">Website</th>
                                    <th scope="col" class="text-center">Phone</th>
                                    <th scope="col" class="text-center">Email</th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr>

                                    <td class="text-center">
                                        {{ $items->name }}
                                    </td>

                                    <td class="text-center">
                                        {{ $items->mailing_address }}
                                    </td>

                                    <td class="text-center">
                                        {{ $items->website }}
                                    </td>
                                    <td class="text-center">
                                        {{ $items->phone }}
                                    </td>
                                    <td class="text-center">
                                        {{ $items->email }}
                                    </td>
                                    
                                    
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

