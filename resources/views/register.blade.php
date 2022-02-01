@extends('layouts.app')
@section('container')
<div>
    <div class="bg-white mt-12 mx-10 md:mx-16 xl:w-44 md:mt-36 xl:mx-auto">
      <div class="container py-4">
        <div class="flex justify-center font-mono">
          <div class="text-xl md:text-3xl">
            <h1>Register</h1>
          </div>
        </div>
        <div class="flex justify-center">
          <form method="POST" action="/dashboard/register/user">
            @if(session()->has('error'))
            <div class="flex justify-center">
              <div class="bg-red-100 border border-red-500 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Message!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                </span>
              </div>
            </div>
            @endif
            <div class="flex justify-center text-center">
                <small style="color:#ACABAB" class="items-center block">Fill your account in this form input and click sign out!</small>
              </div>
            @csrf
                <div class="mt-4 px-12 md:px-4">
                  <select name="rules" class="form-select
                    px-3
                    py-1.5
                    font-normal
                  bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                      <option>open to choose rules</option>
                      <option value="admin">admin</option>
                      <option value="engineer">engineer</option>
                      <option value="user">user</option>
                  </select>
                </div>
            <div style="border-bottom-width:1px;" class="border-black @error('username') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
              <input name="username" class="focus:outline-none w-48 md:w-64" type="text" placeholder="Full name" value="{{ old('username') }}" />
              <div class="@error('username') flex ml-2 items-center text-red-600 @enderror">@error('username')<i class="las la-times"></i>@enderror<i class="las la-user"></i></div>
            </div>
            @error('username')<small class="text-red-500">{{ $message }}</small>@enderror
            <div style="border-bottom-width:1px;" class="border-black @error('email') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
                <input name="email" class="focus:outline-none w-48 md:w-64" type="email" placeholder="Email address" value="{{ old('email') }}" />
                <div class="@error('email') flex ml-2 items-center text-red-600 @enderror">@error('email')<i class="las la-times"></i>@enderror<i class="las la-envelope"></i></div>
            </div>
            @error('email')<small class="text-red-500">{{ $message }}</small>@enderror
            <div style="border-bottom-width:1px;" class="border-black @error('alamat') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
                <input name="alamat" class="focus:outline-none w-48 md:w-64" type="text" placeholder="Home address" value="{{ old('alamat') }}" />
                <div class="@error('alamat') flex ml-2 items-center text-red-600 @enderror">@error('alamat')<i class="las la-times"></i>@enderror<i class="las la-map-marker-alt"></i></div>
            </div>
            @error('alamat')<small class="text-red-500">{{ $message }}</small>@enderror
            <div style="border-bottom-width:1px;" class="border-black @error('nomer') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
                <input name="nomer" class="focus:outline-none w-48 md:w-64" type="text" placeholder="Phone number" value="{{ old('nomer') }}" />
                <div class="@error('nomer') flex ml-2 items-center text-red-600 @enderror">@error('nomer')<i class="las la-times"></i>@enderror<i class="las la-phone"></i></div>
            </div>
            @error('nomer')<small class="text-red-500">{{ $message }}</small>@enderror
            <div style="border-bottom-width:1px;" class="border-black @error('password') border-red-600 @enderror mt-8 w-48 md:w-64 flex justify-between mx-auto">
                <input name="password" class="focus:outline-none w-48 md:w-64" type="password" placeholder="Password" />
                <div class="@error('password') flex ml-2 items-center text-red-600 @enderror">@error('assword')<i class="las la-times"></i>@enderror<i class="las la-lock"></i></div>
            </div>
            @error('password')<small class="text-red-500">{{ $message }}</small>@enderror

            <div class="mt-12 ml-6 md:ml-0 w-64 flex justify-center">
              <button type="submit" class="bg-gray-300 hover:bg-gray-400 focus:outline-none text-gray-800 font-extrabold py-2 px-12 rounded inline-flex items-center">
                <i class="las la-sign-in-alt items-center"></i>
                <span class="ml-">SUBMIT</span>
              </button>
            </div>
            <div class="flex justify-end mb-10 mt-6">
              <a href="/" style="color:#ACABAB" class="">
                <span class="items-center">back to dashboard</span>
                <i class="las la-arrow-right"></i>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
