<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Electric Dashboard</title>
    <link rel="icon" href="icon_path" type="image/icon type">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="/css/highchart.css" />
    <link rel="stylesheet" href="/css/line-awesome.min.css">
    <script src="/js/accessibility.js"></script>
    <script src="/js/export-data.js"></script>
    <script src="/js/exporting.js"></script>
    <script src="/js/highcharts.js"></script>
    <script src="/js/series-label.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css" />
    <style>
        body {
          font-family: "Poppins", sans-serif;
        }
        </style>
  </head>
  <body class="bg-blue-300 md:bg-white">
    <div class="py-4 md:py-0 max-h-screen md:bg-none"> {{--  shadow-none  --}}
      <div class="flex justify-between items-center xl:mx-8 md:mx-8 mx-4">
        <div class="flex mt-4">
            <div class="hidden md:flex md:items-end mt-0 md:mt-2">
                <i class='bx bxs-magnet bx-lg items-center'></i>
                <p class="font-mono items-center text-3xl font-extrabold">Electric</p>
            </div>
            {{-- mobile --}}
          <div class="flex items-center text-md font-bold sm:block md:hidden xl:hidden hover:text-blue-500">
            @if(auth()->user()->rules !== "admin")<a href="/dashboard/profile/{{ auth()->user()->user_id }}" ><i class="las la-cog text-2xl text-white hover:text-blue-200"></i></a>@endif
            <div><img class="rounded-3xl ring-offset-0 block md:hidden ml-1 md:ml-0" height="50px" width="40px" src="/img/{{ auth()->user()->gambar }}" /></div>
            <div class="block text-md text-white md:text-black md:hidden ml-3">{{ auth()->user()->username }}</div>
          </div>
          {{-- end mobile --}}
        </div>
        <div class="hidden md:flex">
        </div>
         {{-- desktop --}}
        <div class="flex mt-4">
          <div class="flex items-center mt-0 md:mt-4">
            <a class="" >
                <div class="hidden text-sm md:text-xl mx-2 font-bold md:block">{{ auth()->user()->username }}</div>
            </a>
            <div><img class="rounded-3xl hidden md:block" height="50px" width="40px" src="/img/{{ auth()->user()->gambar }}" /></div>
          </div>
          <div class="flex mt-0 md:mt-4 ">
            <form action="/logout" method="POST">
                @csrf
            <button type="submit">
                <div class="mx-1"><i class="text-white md:text-black las la-file-export text-3xl hover:text-blue-300"></i></div>
            </button>
            </form>
            @if(auth()->user()->rules !== "admin")<a class="hidden md:block" href="/dashboard/profile/{{ auth()->user()->user_id }}" ><i class="las la-cog text-3xl text-black hover:text-blue-300"></i></a>@endif
          </div>
        </div>
         {{-- end desktop --}}
      </div>
    </div>
    @yield('dashboard')
  </body>
</html>
