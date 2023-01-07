<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'TypeSkip - Generating Great Content') }}</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="https://typeskip.ai/assets/frontend/img/favicon.ico">
    <link rel="icon" href="https://typeskip.ai/assets/frontend/img/favicon.ico">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('css/app-old.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Scripts -->
    @routes
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
        var base_url = "{{ url('/').'/' }}";
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    @env ('production')
    @php echo str_replace('"','',env('GOOGLE_TAG')) @endphp
    @php echo str_replace('"','',env('GOOGLE_ANALYTICS')) @endphp

@endenv

</head>
<body class="font-sans antialiased">
    @env ('production')
    @php echo str_replace('"','',env('GOOGLE_NO_SCRIPT')) @endphp

@endenv

@inertia

@env ('local')
<script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
@endenv


@hasSection('footer')
    @yield('footer')
@else
    <!--********************************************************
                Footer
    /********************************************************-->

@endif
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://typeskip.ai/assets/frontend/js/custom-google-animation.js"></script>
<script src="{{asset('ts/js/wow.min.js')}}"></script>
<script src="/{{mix('js/app.js')}}"></script>
<script src="{{asset('ts/js/app.js')}}"></script>
<script src="//code.tidio.co/rftuxxddgmhuhvmvv96t2rwkksspyi45.js" async></script>
</body>
</html>
