<!DOCTYPE html>
<html lang="en">
<head>
    @notifyCss
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | {{ $subtitle }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/css/line-awesome.min.css">
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    <link rel="icon" href="/img/logo.png">
    <style>
        * {
          font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body height="100%" width="100%">
     <div class="block w-full">
        @yield('container')
     </div>
     @notifyJs
     <x:notify-messages />
</body>
</html>
