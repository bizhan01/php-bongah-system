@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " System Settings Manage";
$createItemName = "Update" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Update";

$breadcrumbMainIcon = "fas fa-project-diagram";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Setting';
$ParentRouteName = 'settings.system';




?>

@section('title')
    تنظیمات سیستم
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')

    <section class="content">
        <div class="container-fluid">

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> صفحه اصلی</a></li>
                <li><a href="{{ route($ParentRouteName) }}"> <i
                                class="material-icons">settings</i> تنظیمات</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> تنظیمات سیستم</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                تنظیمات سیستم را تغییر دهید
                            </h2>
                            <br>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.update') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>فرمت تاریخ</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="date_format"
                                                            id="">
                                                        <option @if ( $settings['date_format']=='d-m-Y' )
                                                                selected=""
                                                                @endif value="d-m-Y">dd-mm-YYYY (05-12-2019)
                                                        </option>

                                                        <option @if ( $settings['date_format']=='m-d-Y' )
                                                                selected=""
                                                                @endif value="m-d-Y">mm-dd-YYYY (12-05-2019)
                                                        </option>

                                                        <option @if ( $settings['date_format']=='d-M-Y' )
                                                                selected=""
                                                                @endif value="d-M-Y">dd-MM-YYYY (05-Dec-2019)
                                                        </option>
                                                        <option @if ( $settings['date_format']=='M-d-Y' )
                                                                selected=""
                                                                @endif value="M-d-Y">MM-dd-YYYY (Dec-05-2019)
                                                        </option>
                                                        <option @if ( $settings['date_format']=='M d, Y' )
                                                                selected=""
                                                                @endif value="M d, Y">MM dd, YYYY (Dec 05, 2019)
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>منطقه زمانی</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="timezone"
                                                            id="">
                                                        <option @if ( $settings['timezone']=='Pacific/Midway' )
                                                                selected=""
                                                                @endif value="Pacific/Midway">(GMT-11:00) Midway Island
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Samoa' )
                                                                selected=""
                                                                @endif value="US/Samoa">(GMT-11:00) Samoa
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Hawaii' )
                                                                selected=""
                                                                @endif value="US/Hawaii">(GMT-10:00) Hawaii
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Alaska' )
                                                                selected=""
                                                                @endif value="US/Alaska">(GMT-09:00) Alaska
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Pacific' )
                                                                selected=""
                                                                @endif value="US/Pacific">(GMT-08:00) Pacific Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Tijuana' )
                                                                selected=""
                                                                @endif value="America/Tijuana">(GMT-08:00) Tijuana
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Arizona' )
                                                                selected=""
                                                                @endif value="US/Arizona">(GMT-07:00) Arizona
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Mountain' )
                                                                selected=""
                                                                @endif value="US/Mountain">(GMT-07:00) Mountain Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Chihuahua' )
                                                                selected=""
                                                                @endif value="America/Chihuahua">(GMT-07:00) Chihuahua
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Mazatlan' )
                                                                selected=""
                                                                @endif value="America/Mazatlan">(GMT-07:00) Mazatlan
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Mexico_City' )
                                                                selected=""
                                                                @endif value="America/Mexico_City">(GMT-06:00) Mexico
                                                            City
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Monterrey' )
                                                                selected=""
                                                                @endif value="America/Monterrey">(GMT-06:00) Monterrey
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Canada/Saskatchewan' )
                                                                selected=""
                                                                @endif value="Canada/Saskatchewan">(GMT-06:00)
                                                            Saskatchewan
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Central' )
                                                                selected=""
                                                                @endif value="US/Central">(GMT-06:00) Central Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/Eastern' )
                                                                selected=""
                                                                @endif value="US/Eastern">(GMT-05:00) Eastern Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option @if ( $settings['timezone']=='US/East-Indiana' )
                                                                selected=""
                                                                @endif value="US/East-Indiana">(GMT-05:00) Indiana
                                                            (East)
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Bogota' )
                                                                selected=""
                                                                @endif value="America/Bogota">(GMT-05:00) Bogota
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Lima' )
                                                                selected=""
                                                                @endif value="America/Lima">(GMT-05:00) Lima
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Caracas' )
                                                                selected=""
                                                                @endif value="America/Caracas">(GMT-04:30) Caracas
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Canada/Atlantic' )
                                                                selected=""
                                                                @endif value="Canada/Atlantic">(GMT-04:00) Atlantic Time
                                                            (Canada)
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/La_Paz' )
                                                                selected=""
                                                                @endif value="America/La_Paz">(GMT-04:00) La Paz
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Santiago' )
                                                                selected=""
                                                                @endif value="America/Santiago">(GMT-04:00) Santiago
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Canada/Newfoundland' )
                                                                selected=""
                                                                @endif value="Canada/Newfoundland">(GMT-03:30)
                                                            Newfoundland
                                                        </option>
                                                        <option @if ( $settings['timezone']=='America/Buenos_Aires' )
                                                                selected=""
                                                                @endif value="America/Buenos_Aires">(GMT-03:00) Buenos
                                                            Aires
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Greenland' )
                                                                selected=""
                                                                @endif value="Greenland">(GMT-03:00) Greenland
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Atlantic/Stanley' )
                                                                selected=""
                                                                @endif value="Atlantic/Stanley">(GMT-02:00) Stanley
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Atlantic/Azores' )
                                                                selected=""
                                                                @endif value="Atlantic/Azores">(GMT-01:00) Azores
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Atlantic/Cape_Verde' )
                                                                selected=""
                                                                @endif value="Atlantic/Cape_Verde">(GMT-01:00) Cape
                                                            Verde Is.
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Africa/Casablanca' )
                                                                selected=""
                                                                @endif value="Africa/Casablanca">(GMT) Casablanca
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Dublin' )
                                                                selected=""
                                                                @endif value="Europe/Dublin">(GMT) Dublin
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Lisbon' )
                                                                selected=""
                                                                @endif value="Europe/Lisbon">(GMT) Lisbon
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/London' )
                                                                selected=""
                                                                @endif value="Europe/London">(GMT) London
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Africa/Monrovia' )
                                                                selected=""
                                                                @endif value="Africa/Monrovia">(GMT) Monrovia
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Amsterdam' )
                                                                selected=""
                                                                @endif value="Europe/Amsterdam">(GMT+01:00) Amsterdam
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Belgrade' )
                                                                selected=""
                                                                @endif value="Europe/Belgrade">(GMT+01:00) Belgrade
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Berlin' )
                                                                selected=""
                                                                @endif value="Europe/Berlin">(GMT+01:00) Berlin
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Bratislava' )
                                                                selected=""
                                                                @endif value="Europe/Bratislava">(GMT+01:00) Bratislava
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Brussels' )
                                                                selected=""
                                                                @endif value="Europe/Brussels">(GMT+01:00) Brussels
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Budapest' )
                                                                selected=""
                                                                @endif value="Europe/Budapest">(GMT+01:00) Budapest
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Copenhagen' )
                                                                selected=""
                                                                @endif value="Europe/Copenhagen">(GMT+01:00) Copenhagen
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Ljubljana' )
                                                                selected=""
                                                                @endif value="Europe/Ljubljana">(GMT+01:00) Ljubljana
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Madrid' )
                                                                selected=""
                                                                @endif value="Europe/Madrid">(GMT+01:00) Madrid
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Paris' )
                                                                selected=""
                                                                @endif value="Europe/Paris">(GMT+01:00) Paris
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Prague' )
                                                                selected=""
                                                                @endif value="Europe/Prague">(GMT+01:00) Prague
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Rome' )
                                                                selected=""
                                                                @endif value="Europe/Rome">(GMT+01:00) Rome
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Sarajevo' )
                                                                selected=""
                                                                @endif value="Europe/Sarajevo">(GMT+01:00) Sarajevo
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Skopje' )
                                                                selected=""
                                                                @endif value="Europe/Skopje">(GMT+01:00) Skopje
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Stockholm' )
                                                                selected=""
                                                                @endif value="Europe/Stockholm">(GMT+01:00) Stockholm
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Vienna' )
                                                                selected=""
                                                                @endif value="Europe/Vienna">(GMT+01:00) Vienna
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Warsaw' )
                                                                selected=""
                                                                @endif value="Europe/Warsaw">(GMT+01:00) Warsaw
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Zagreb' )
                                                                selected=""
                                                                @endif value="Europe/Zagreb">(GMT+01:00) Zagreb
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Athens' )
                                                                selected=""
                                                                @endif value="Europe/Athens">(GMT+02:00) Athens
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Bucharest' )
                                                                selected=""
                                                                @endif value="Europe/Bucharest">(GMT+02:00) Bucharest
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Africa/Cairo' )
                                                                selected=""
                                                                @endif value="Africa/Cairo">(GMT+02:00) Cairo
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Africa/Harare' )
                                                                selected=""
                                                                @endif value="Africa/Harare">(GMT+02:00) Harare
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Helsinki' )
                                                                selected=""
                                                                @endif value="Europe/Helsinki">(GMT+02:00) Helsinki
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Istanbul' )
                                                                selected=""
                                                                @endif value="Europe/Istanbul">(GMT+02:00) Istanbul
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Jerusalem' )
                                                                selected=""
                                                                @endif value="Asia/Jerusalem">(GMT+02:00) Jerusalem
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Kiev' )
                                                                selected=""
                                                                @endif value="Europe/Kiev">(GMT+02:00) Kyiv
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Minsk' )
                                                                selected=""
                                                                @endif value="Europe/Minsk">(GMT+02:00) Minsk
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Riga' )
                                                                selected=""
                                                                @endif value="Europe/Riga">(GMT+02:00) Riga
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Sofia' )
                                                                selected=""
                                                                @endif value="Europe/Sofia">(GMT+02:00) Sofia
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/TAllinn' )
                                                                selected=""
                                                                @endif value="Europe/TAllinn">(GMT+02:00) TAllinn
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Vilnius' )
                                                                selected=""
                                                                @endif value="Europe/Vilnius">(GMT+02:00) Vilnius
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Baghdad' )
                                                                selected=""
                                                                @endif value="Asia/Baghdad">(GMT+03:00) Baghdad
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Kuwait' )
                                                                selected=""
                                                                @endif value="Asia/Kuwait">(GMT+03:00) Kuwait
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Africa/Nairobi' )
                                                                selected=""
                                                                @endif value="Africa/Nairobi">(GMT+03:00) Nairobi
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Riyadh' )
                                                                selected=""
                                                                @endif value="Asia/Riyadh">(GMT+03:00) Riyadh
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Moscow' )
                                                                selected=""
                                                                @endif value="Europe/Moscow">(GMT+03:00) Moscow
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Tehran' )
                                                                selected=""
                                                                @endif value="Asia/Tehran">(GMT+03:30) Tehran
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Baku' )
                                                                selected=""
                                                                @endif value="Asia/Baku">(GMT+04:00) Baku
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Europe/Volgograd' )
                                                                selected=""
                                                                @endif value="Europe/Volgograd">(GMT+04:00) Volgograd
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Muscat' )
                                                                selected=""
                                                                @endif value="Asia/Muscat">(GMT+04:00) Muscat
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Tbilisi' )
                                                                selected=""
                                                                @endif value="Asia/Tbilisi">(GMT+04:00) Tbilisi
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Yerevan' )
                                                                selected=""
                                                                @endif value="Asia/Yerevan">(GMT+04:00) Yerevan
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Kabul' )
                                                                selected=""
                                                                @endif value="Asia/Kabul">(GMT+04:30) Kabul
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Karachi' )
                                                                selected=""
                                                                @endif value="Asia/Karachi">(GMT+05:00) Karachi
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Tashkent' )
                                                                selected=""
                                                                @endif value="Asia/Tashkent">(GMT+05:00) Tashkent
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Kolkata' )
                                                                selected=""
                                                                @endif value="Asia/Kolkata">(GMT+05:30) Kolkata
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Kathmandu' )
                                                                selected=""
                                                                @endif value="Asia/Kathmandu">(GMT+05:45) Kathmandu
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Yekaterinburg' )
                                                                selected=""
                                                                @endif value="Asia/Yekaterinburg">(GMT+06:00)
                                                            Ekaterinburg
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Almaty' )
                                                                selected=""
                                                                @endif value="Asia/Almaty">(GMT+06:00) Almaty
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Dhaka' )
                                                                selected=""
                                                                @endif value="Asia/Dhaka">(GMT+06:00) Dhaka
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Novosibirsk' )
                                                                selected=""
                                                                @endif value="Asia/Novosibirsk">(GMT+07:00) Novosibirsk
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Bangkok' )
                                                                selected=""
                                                                @endif value="Asia/Bangkok">(GMT+07:00) Bangkok
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Jakarta' )
                                                                selected=""
                                                                @endif value="Asia/Jakarta">(GMT+07:00) Jakarta
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Krasnoyarsk' )
                                                                selected=""
                                                                @endif value="Asia/Krasnoyarsk">(GMT+08:00) Krasnoyarsk
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Chongqing' )
                                                                selected=""
                                                                @endif value="Asia/Chongqing">(GMT+08:00) Chongqing
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Hong_Kong' )
                                                                selected=""
                                                                @endif value="Asia/Hong_Kong">(GMT+08:00) Hong Kong
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Kuala_Lumpur' )
                                                                selected=""
                                                                @endif value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala
                                                            Lumpur
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Perth' )
                                                                selected=""
                                                                @endif value="Australia/Perth">(GMT+08:00) Perth
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Singapore' )
                                                                selected=""
                                                                @endif value="Asia/Singapore">(GMT+08:00) Singapore
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Taipei' )
                                                                selected=""
                                                                @endif value="Asia/Taipei">(GMT+08:00) Taipei
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Ulaanbaatar' )
                                                                selected=""
                                                                @endif value="Asia/Ulaanbaatar">(GMT+08:00) Ulaan Bataar
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Urumqi' )
                                                                selected=""
                                                                @endif value="Asia/Urumqi">(GMT+08:00) Urumqi
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Irkutsk' )
                                                                selected=""
                                                                @endif value="Asia/Irkutsk">(GMT+09:00) Irkutsk
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Seoul' )
                                                                selected=""
                                                                @endif value="Asia/Seoul">(GMT+09:00) Seoul
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Tokyo' )
                                                                selected=""
                                                                @endif value="Asia/Tokyo">(GMT+09:00) Tokyo
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Adelaide' )
                                                                selected=""
                                                                @endif value="Australia/Adelaide">(GMT+09:30) Adelaide
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Darwin' )
                                                                selected=""
                                                                @endif value="Australia/Darwin">(GMT+09:30) Darwin
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Yakutsk' )
                                                                selected=""
                                                                @endif value="Asia/Yakutsk">(GMT+10:00) Yakutsk
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Brisbane' )
                                                                selected=""
                                                                @endif value="Australia/Brisbane">(GMT+10:00) Brisbane
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Canberra' )
                                                                selected=""
                                                                @endif value="Australia/Canberra">(GMT+10:00) Canberra
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Pacific/Guam' )
                                                                selected=""
                                                                @endif value="Pacific/Guam">(GMT+10:00) Guam
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Hobart' )
                                                                selected=""
                                                                @endif value="Australia/Hobart">(GMT+10:00) Hobart
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Melbourne' )
                                                                selected=""
                                                                @endif value="Australia/Melbourne">(GMT+10:00) Melbourne
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Pacific/Port_Moresby' )
                                                                selected=""
                                                                @endif value="Pacific/Port_Moresby">(GMT+10:00) Port
                                                            Moresby
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Australia/Sydney' )
                                                                selected=""
                                                                @endif value="Australia/Sydney">(GMT+10:00) Sydney
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Vladivostok' )
                                                                selected=""
                                                                @endif value="Asia/Vladivostok">(GMT+11:00) Vladivostok
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Asia/Magadan' )
                                                                selected=""
                                                                @endif value="Asia/Magadan">(GMT+12:00) Magadan
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Pacific/Auckland' )
                                                                selected=""
                                                                @endif value="Pacific/Auckland">(GMT+12:00) Auckland
                                                        </option>
                                                        <option @if ( $settings['timezone']=='Pacific/Fiji' )
                                                                selected=""
                                                                @endif value="Pacific/Fiji">(GMT+12:00) Fiji
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>واحد پول</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select name="currency_code" data-live-search="true"
                                                            class="form-control show-tick"
                                                    >
                                                        <option @if ($settings['currency_code']=='تومان')
                                                                selected=""
                                                                @endif value="تومان">تومان
                                                        </option>

                                                        <option @if ($settings['currency_code']=='USD')
                                                                selected=""
                                                                @endif value="USD">USD
                                                        </option>
                                                        <option @if ($settings['currency_code']=='INR')
                                                                selected=""
                                                                @endif value="INR">INR
                                                        </option>
                                                        <option @if ($settings['currency_code']=='GBP')
                                                                selected=""
                                                                @endif value="GBP">GBP
                                                        </option>
                                                        <option @if ($settings['currency_code']=='JPY')
                                                                selected=""
                                                                @endif value="JPY">JPY
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>نماد پول </p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select name="currency_symbol" data-live-search="true"
                                                            class="form-control show-tick"
                                                    >
                                                        <option @if ($settings['currency_symbol']=='تومان')
                                                                selected=""
                                                                @endif value="تومان">تومان
                                                        </option>

                                                        <option @if ($settings['currency_symbol']=='$')
                                                                selected=""
                                                                @endif value="$">USD &#36;
                                                        </option>

                                                        <option @if ($settings['currency_symbol']=='₹')
                                                                selected=""
                                                                @endif value="₹">Rupee &#8377;
                                                        </option>
                                                        <option @if ($settings['currency_symbol']=='£')
                                                                selected=""
                                                                @endif value="£">Pounds sterling &#163;
                                                        </option>
                                                        <option @if ($settings['currency_symbol']=='¥')
                                                                selected=""
                                                                @endif value="¥">Japanese yen &#165;
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>واحد پول (نماد/کد)</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control show-tick"
                                                            name="is_code"
                                                            id="">
                                                        <option @if ( $settings['is_code']=='code' )
                                                                selected=""
                                                                @endif value="code">کد پول
                                                        </option>
                                                        <option @if ( $settings['is_code']=='symbol' )
                                                                selected=""
                                                                @endif value="symbol">نماد پول
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>موقعیت نماد پول</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control show-tick"
                                                            name="currency_position"
                                                            id="">
                                                        <option @if ( $settings['currency_position']=='Prefix' )
                                                                selected=""
                                                                @endif value="Prefix">پیشوند
                                                        </option>
                                                        <option @if ( $settings['currency_position']=='Suffix' )
                                                                selected=""
                                                                @endif value="Suffix">پسوند
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <p>تاریخ اولین معامله</p>
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ date('d/m/Y', strtotime($settings['fixed_asset_schedule_starting_date']))  }}"
                                                           name="fixed_asset_schedule_starting_date"
                                                           type="text"
                                                           class="form-control"
                                                           placeholder="Please choose a date...">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    بروزرسانی
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
        </div>
    </section>

@stop

@push('include-css')

    <!-- Colorpicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet"/>

    <!-- Dropzone Css -->
    <link href="{{ asset('asset/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('asset/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
          rel="stylesheet"/>

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>


    <!-- noUISlider Css -->
    <link href="{{ asset('asset/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet"/>

    <!-- Sweet Alert Css -->
    <link href="{{ asset('asset/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"/>


@endpush

@push('include-js')


    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('asset/plugins/sweetalert/sweetalert.min.js') }}"></script>


    <!-- Autosize Plugin Js -->
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>


    <script>

        @if(Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif

                @if(Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif



                @if ($errors->any())
                @foreach ($errors->All() as $error)
            toastr["error"]('{{ $error }}');
        @endforeach
        @endif


    </script>

@endpush
