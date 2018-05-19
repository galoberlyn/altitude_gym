<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

    <link rel="apple-touch-icon" sizes="60x60" href="memimg/alti-icon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="memimg/alti-icon.png">
    <link rel="apple-touch-icon" sizes="120x120" href="memimg/alti-icon.png">
    <link rel="apple-touch-icon" sizes="152x152" href="memimg/alti-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="memimg/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="memimg/favicon.ico">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #191919;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #191919;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            
            body {
                background-image: url(images/bg-2.jpg);
                background-size:     cover;
                background-repeat:   no-repeat;
                background-position: center center;
            }

            
            .trans{
                margin-top: 25px;
    font-size: 21px;
    text-align: center;
    animation: fadein 2s;
    -moz-animation: fadein 2s; /* Firefox */
    -webkit-animation: fadein 2s; /* Safari and Chrome */
    -o-animation: fadein 2s; /* Opera */
            }
            
            @keyframes fadein {
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-moz-keyframes fadein { /* Firefox */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-webkit-keyframes fadein { /* Safari and Chrome */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-o-keyframes fadein { /* Opera */
    from {
        opacity:0;
    }
    to {
        opacity: 1;
    }
}

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}"></a>
                    @else
                        <a href="{{ url('/login') }}"></a>
               
                    @endif
                </div>
            @endif

            <div class="content trans" style="color:white">
                <div class="title m-b-md">
                    ALTITUDE GYM
                </div>
                

                <div class="links">
                    <a href="/login" style="color:white">Login</a>
               
                    
                </div>
            </div>
        </div>
    </body>
</html>
