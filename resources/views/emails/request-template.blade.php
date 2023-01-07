<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('/') }}assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('/') }}assets/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        @media screen and (max-width:640px) {
            .mob {
                right: 0 !important;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                width: auto !important;
                margin-left: 10px;
                margin-right: 10px;
            }

            .mob {
                position: relative !important;
                text-align: center;
                top: 10px !important;
                right: 0 !important;
            }

            .mob img {
                width: 240px;
                height: auto;
            }
        }

    </style>
</head>

<body style="margin:0; padding:0;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label for="content">Message</label> 
                <p>{{ $data }}</p>       
            </div>
        </div>
    </div>    
</body>
</html>
