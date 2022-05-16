<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 54px;
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Connexion</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Créer un compte</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="title m-b-md">
                    Marketplace
                </div>

                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="580.000000pt" height="220.000000pt" viewBox="0 0 1280.000000 720.000000"
 preserveAspectRatio="xMidYMid meet">
<metadata>
</metadata>
<g transform="translate(0.000000,720.000000) scale(0.100000,-0.100000)"
fill="#000000" stroke="none">
<path d="M6337 6523 c-19 -16 -61 -46 -92 -68 -32 -22 -86 -60 -120 -85 -34
-25 -117 -83 -184 -130 -67 -47 -148 -103 -179 -126 -70 -50 -857 -607 -1197
-847 -304 -214 -371 -262 -433 -307 -27 -19 -104 -73 -171 -120 -67 -47 -138
-96 -156 -110 -34 -25 -77 -55 -265 -187 -52 -36 -114 -80 -137 -97 -23 -17
-64 -46 -91 -65 -26 -19 -68 -62 -92 -95 l-44 -61 0 -115 -1 -115 55 -78 c129
-184 178 -230 278 -263 77 -24 147 -15 204 28 25 18 69 50 99 71 158 110 420
295 970 685 168 119 354 251 412 292 59 41 153 107 209 147 57 40 127 89 157
110 29 21 82 58 116 83 34 25 87 62 116 83 125 87 195 136 394 278 116 82 212
149 215 149 6 0 293 -201 515 -359 39 -28 104 -74 145 -102 41 -29 181 -127
310 -219 129 -92 399 -283 600 -425 201 -142 426 -301 500 -354 74 -53 151
-107 171 -121 35 -23 86 -59 251 -177 37 -26 109 -77 160 -113 l93 -65 70 0
c54 0 82 6 125 26 70 33 102 63 182 174 110 152 108 148 108 268 l0 105 -41
61 c-44 66 -5 37 -702 531 -199 141 -245 184 -294 277 -70 132 -67 104 -73
688 l-5 530 -23 45 c-30 56 -96 126 -144 151 -84 43 -118 49 -291 49 -181 0
-256 -15 -329 -63 -45 -31 -115 -119 -129 -164 -7 -22 -15 -130 -18 -248 -9
-332 -13 -333 -323 -114 -339 239 -699 495 -765 543 -73 54 -105 58 -156 19z"/>
<path d="M6270 5120 c-52 -38 -108 -78 -125 -90 -16 -12 -88 -63 -160 -113
-71 -51 -159 -113 -195 -138 -36 -25 -261 -184 -500 -354 -239 -170 -474 -336
-523 -369 -48 -34 -119 -83 -157 -111 -37 -27 -100 -72 -140 -100 -39 -27
-100 -72 -135 -98 l-65 -48 0 -1246 c0 -867 3 -1266 11 -1312 20 -117 103
-262 198 -343 56 -48 159 -107 209 -120 23 -6 45 -14 48 -19 3 -5 250 -9 554
-9 485 0 550 2 564 16 14 14 16 94 16 730 l0 714 530 0 530 0 0 -714 c0 -636
2 -716 16 -730 14 -14 78 -16 559 -16 l543 0 70 29 c100 40 159 77 224 139 77
73 135 165 164 259 l24 78 0 1273 0 1272 -26 23 c-14 12 -51 40 -83 62 -32 22
-92 63 -132 92 -99 70 -227 160 -324 228 -44 31 -114 81 -155 111 -41 29 -109
77 -150 105 -41 29 -174 122 -295 208 -121 87 -321 228 -445 316 -124 87 -254
180 -290 205 -237 170 -224 168 -360 70z"/>
</g>
</svg>
            </div>
        </div>
    </body>
</html>
