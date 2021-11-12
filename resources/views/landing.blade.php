<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}


        <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="{{ asset('template/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template/css/lightpick.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">


        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv


    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('template/js/script.js') }}" ></script>
  <script src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="{{ asset('template/js/lightpick.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</html>

<script>
    //Date picker
    var picker = new Lightpick({
      field: document.getElementById('check-in'),
      secondField: document.getElementById('check-out'),
      singleDate: false,
      minDate: new Date(),
      numberOfMonths: 2,
      onSelect: function (start, end) {
        var str1 = '';
        var str2 = '';
        str1 += start ? start.format('Do MMMM YYYY') : '';
        str2 += end ? end.format('Do MMMM YYYY') : '...';
        document.getElementById('result-1').innerHTML = str1;
        document.getElementById('result-2').innerHTML = str2;
      }
    });



  </script>


  <script>
    $(".js-example-tags").select2({
      tags: true
    });
  </script>
