<!DOCTYPE html>
<html lang="en">
  <head>
    @notifyCss
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }} | {{ $subtitle }}</title>
    <link rel="icon" href="/img/logo.png">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    <link rel="stylesheet" href="/css/line-awesome.min.css">
    <link rel='stylesheet' href='/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css" />
    <script src="/js/accessibility.js"></script>
    <script src="/js/export-data.js"></script>
    <script src="/js/exporting.js"></script>
    <script src="/js/highcharts.js"></script>
    <script src="/js/series-label.js"></script>
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/loading-bar.css"/>
    <script type="text/javascript" src="/js/loading-bar.js"></script>
    <style>
        body {
          font-family: "Poppins", sans-serif;
        }
    </style>
{{-- fbfbfe --}}
  </head>
  <body style="background-color: #fbfefe;" class="max-w-screen-3xl mx-auto">
    <div class="max-h-screen py-4 md:py-4 lg:py-4 xl:py-4 2xl:py-4">
      <div class="flex py-2 px-4 md:px-12 shadow-md rounded-full justify-between items-center mx-4 md:mx-8 lg:mx-8 xl:mx-8 2xl:mx-8">
        <div class="flex mt-4">
            <a href="/dashboard">
            <div class="hidden md:flex md:space-x-4 md:items-center mt-0">
                <div class="flex items-center">
                    <i class='bx bxs-magnet items-center text-slate-500 bx-xs'></i>
                    <p class="font-sans text-slate-500 text-md font-extrabold">-elektrik</p>
                </div>
                <div class="flex space-x-1">
                    <i class="bx bxs-home text-slate-500 items-center"></i>
                    <p class="text-xs text-gray-400"> / </p>
                    <p class="text-xs text-gray-400 font-bold">{{ $title }}</p>
                    <p class="text-xs text-gray-400"> / </p>
                    <p class="text-xs text-gray-400"> {{ $subtitle}}</p>
                </div>
            </div>
            </a>
            {{-- navbar for mobile  --}}
          <div class="flex items-center text-md font-medium md:hidden lg:hidden xl:hidden 2xl:hidden">
           <a href="/dashboard/profile/{{ auth()->user()->user_id }}" ><i class="mt-1 md:mt-0 las la-cog text-xl text-gray-500 hover:text-blue-300"></i></a>
            <div><img class="rounded-3xl ring-offset-0 block md:hidden lg:hidden xl:hidden 2xl:hidden ml-1 md:ml-0 lg:ml-0 xl:ml-0 2xl:ml-0" height="50px" width="40px" src="/img/{{ auth()->user()->gambar }}" /></div>
            <div class="block text-md text-slate-500 md:hidden ml-3 lg:hidden xl:hidden 2xl:hidden">{{ auth()->user()->username }}</div>
          </div>
          {{-- end navbar mobile --}}
        </div>
         {{-- navbar for desktop --}}
        <div class="flex space-x-2 mt-4">
          <div class="flex items-center mt-0">
            <a class="">
                <div class="hidden text-sm md:text-md font-semibold mx-2 text-slate-500 md:block">{{ auth()->user()->username }}</div>
            </a>
            <div><img class="rounded-3xl hidden md:inline-block lg:inline-block xl:inline-block 2xl:inline-block" height="30px" width="30px" src="/img/{{ auth()->user()->gambar }}" /></div>
          </div>
          <div class="flex space-x-2 mt-3 md:mt-[2px] mb-3 md:mb-0">
            <form action="/logout" method="POST">
                @csrf
            <button class="relative outline-none rounded-full bg-blue-400 hover:bg-blue-200 focus:outline-none" type="submit">
                <div class="mx-1"><i class="las la-file-export outline-none focus:outline-none text-white text-md md:text-md "></i></div>
            </button>
            </form>
            <a class="hidden md:block" href="/dashboard/profile/{{ auth()->user()->user_id }}" ><i class="las la-cog text-2xl text-gray-500 hover:text-blue-300"></i></a>
          </div>
        </div>
         {{-- end navbar desktop --}}
      </div>
    </div>
    <div class="px-0 md:px-4 xl:px-4 2xl:px-16">
        @yield('dashboard')
    </div>
    @notifyJs
    <x:notify-messages />
</body>
</html>
