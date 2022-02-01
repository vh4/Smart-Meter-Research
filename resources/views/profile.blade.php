<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spade - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="/css/highchart.css" />
    <link rel="stylesheet" href="/css/line-awesome.min.css">
    <script src="/js/accessibility.js"></script>
    <script src="/js/export-data.js"></script>
    <script src="/js/exporting.js"></script>
    <script src="/js/highcharts.js"></script>
    <script src="/js/series-label.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
        body {
          font-family: "Sofia", sans-serif;
        }
        </style>
  </head>
  <body>
@if(session()->has('success'))
<div class="flex justify-center mt-10">
  <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Message!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
    </span>
  </div>
</div>
@endif
<div class="pt-12 md:pt-20 text-center font-mono">
    <div class="flex justify-center space-x-2 mr-4">
        <i class="lar la-address-card text-4xl"></i>
        <h1 class="text-2xl font-bold">Edit Profile</h1>
    </div>
        @error('gambar')<small class="text-red-500 mr-10">{{ $message }}</small>@enderror
        <div class="flex justify-center">
        <form method="POST" action="/dashboard/profile/{{ $user->user_id }}" enctype="multipart/form-data">
          @csrf
          <div class="flex justify-center pt-6">
            <label class="flex" for="gambar">
              <img class="rounded-full" src="/img/{{ $user->gambar }}" width="150" alt="" />
                <i class="las la-edit text-3xl"></i>
            </label>`
            </div>
            <div aria-readonly="true" style="border-bottom-width:1px;" class="border-black font-bold  mt-8 w-48 md:w-64 flex justify-between mx-auto">
                <input name="username" class="focus:outline-none w-48 md:w-64" type="text" placeholder="name" value="YOUR ID : {{ $user->user_id }}" readonly />
            </div>
          <div style="border-bottom-width:1px;" class="border-black @error('username') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
            <input name="username" class="focus:outline-none w-48 md:w-64" type="text" placeholder="name" value="{{ $user->username }}" />
            <div class="@error('username') flex ml-2 items-center text-red-600 @enderror">@error('username')<i class="las la-times"></i>@enderror<i class="las la-user"></i></div>
          </div>
          @error('username')<small class="text-red-500">{{ $message }}</small>@enderror
          <div style="border-bottom-width:1px;" class="border-black @error('email') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
              <input name="email" class="focus:outline-none w-48 md:w-64" type="email" placeholder="email" value="{{ $user->email }}" />
              <div class="@error('email') flex ml-2 items-center text-red-600 @enderror">@error('email')<i class="las la-times"></i>@enderror<i class="las la-envelope"></i></div>
          </div>
          @error('email')<small class="text-red-500">{{ $message }}</small>@enderror
          <div style="border-bottom-width:1px;" class="border-black @error('alamat') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
            <input name="alamat" class="focus:outline-none w-48 md:w-64" type="text" placeholder="alamat" value="{{ $user->alamat }}" />
            <div class="@error('alamat') flex ml-2 items-center text-red-600 @enderror">@error('alamat')<i class="las la-times"></i>@enderror<i class="las la-envelope"></i></div>
        </div>
        @error('nomer')<small class="text-red-500">{{ $message }}</small>@enderror
        <div style="border-bottom-width:1px;" class="border-black @error('nomer') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
            <input name="nomer" class="focus:outline-none w-48 md:w-64" type="text" placeholder="nomer" value="{{ $user->nomer }}" />
            <div class="@error('nomer') flex ml-2 items-center text-red-600 @enderror">@error('nomer')<i class="las la-times"></i>@enderror<i class="las la-envelope"></i></div>
        </div>
        @error('nomer')<small class="text-red-500">{{ $message }}</small>@enderror
          <div style="border-bottom-width:1px;" class="border-black @error('password') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
              <input name="password" class="focus:outline-none w-48 md:w-64" type="password" placeholder="password" value="{{ $user->password }}" />
              <div class="@error('password') flex ml-2 items-center text-red-600 @enderror">@error('password')<i class="las la-times"></i>@enderror<i class="las la-lock"></i></div>
          </div>
            <input  type="file" style="display:none;" id="gambar" name="gambar" class="focus:outline-none w-48 md:w-64" />
          <small class="text-blue-500">Mau ganti password? hapus dulu!</small>
          @error('password')<small class="text-red-500">{{ $message }}</small>@enderror
          <div class="mt-2 md:mt-12 w-64 flex justify-center">
            <button type="submit" class="bg-gray-300 hover:bg-gray-400 focus:outline-none text-gray-800 font-extrabold py-2 px-8 rounded inline-flex items-center">
              <span class="ml-2">Submit</span>
            </button>
          </div>
          <div class="flex justify-end mt-2 md:mt-4">
            <a href="/" style="color:#ACABAB" class="">
              <span class="items-center">Back to dashboard</span>
              <i class="las la-arrow-right"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
