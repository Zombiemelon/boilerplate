<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: transparent;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .centerbox {
                font-size: 32px;
                padding: 20px;
                border-radius: 5px;
                background: linear-gradient(234deg, rgba(34,193,195,1) 26%, rgba(253,187,45,1) 100%);
                position: absolute;
                margin: 0;
                top: 50%;
                left: 50%;
                width: 50%;
                transform: translate(-50%, -50%);
            }
            .innerbox {
                margin: auto;
                width: 50%;
                border-radius: 5px;
                padding: 5px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center">
                    <div class="centerbox">
                        <div class="innerbox">
                            Your Document is in Attachment ☀️
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>
