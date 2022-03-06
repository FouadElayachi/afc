<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/app.css">
        <link rel="icon" href="img/logo.png" />
        <title>أكاديمية أطر الغد</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-image: url("img/back.jpg");
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .popover{
                max-width: 100%;
            }
            .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
            }
            strong{
                color: #1b77b9;
            }
            /* __ Fixed Social Networks __ */

            .FxSocial {
                position: fixed;
                right: 0;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                transform: translateY(-50%);
            }

            .FxSocial li.Fxitem.facebook { background-color: #507cbe; }
            .FxSocial li.Fxitem.youtube { background-color: #f16160; }
            .FxSocial li.Fxitem.twitter { background-color: #65cdf0; }
            .FxSocial li.Fxitem.instagram { background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%); }

            .FxSocial li.Fxitem a {
                width: 43px;
                height: 43px;
                display: block;
                color: white;
                font-size: 23px;
                line-height: 43px;
                text-align: center;
            }
            ol, ul{ list-style: none; }
            a:hover{ text-decoration: none; }

        </style>
    </head>
    <body class="droid-arabic-kufi">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-left links" dir="rtl">
                    @auth
                        <a href="{{ url('/الرئيسية') }}">الرئيسية</a>
                    @else
                        <a href="{{ url('/الدخول') }}">الدخول</a>

                        <!--@if (Route::has('register'))
                            <a href="{{ url('/التسجيل') }}">التسجيل</a>
                        @endif-->
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                <img class="img-fluid" alt="أكاديمية أطر الغد" src="img/afc.png" width="800px" />
                </div>

                <div class="links" dir="rtl">
                    <a data-toggle="popover-hover" data-img="img/flow/afc.jpg">ما هي الأكاديمية ؟</a>
                    <a data-toggle="popover-hover" data-img="img/flow/public.jpg">الفئة المستهدفة</a>
                    <a data-toggle="popover-hover" data-img="img/flow/chance.png">فرصة</a>              
            </div>
        </div>
    </body>
    <div class="navbar-expand-md navbar-light navbar-laravel footer" dir="rtl">
        <p class="mt-3">جميع الحقوق محفوظة  © <strong>أكاديمية أطر الغد</strong> 2019</p>

    </div>
    <div class="FxSocial">
        <ul>
            <li class="Fxitem twitter" title="فرنسية"><a href="/fr">فر</a></li>
            <li class="Fxitem facebook" title="عربية"><a href="/">عر</a></li>
        </ul>
    </div>
</html>
<script src="{{ asset('/js/app.js')}}"></script>
<script>
    $('[data-toggle="popover-hover"]').popover({
    html: true,
    trigger: 'hover',
    placement: 'top',
    content: function () { return '<img src="' + $(this).data('img') + '" width="400px"/>'; }
    });
</script>