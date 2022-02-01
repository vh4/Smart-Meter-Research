@extends('layouts.app')
@section('container')
<style>
    .bayangan{
        filter: drop-shadow(0 20px 13px rgb(0 0 0 / 0.03)) drop-shadow(0 8px 5px rgb(0 0 0 / 0.08));
    }
</style>
   <div>
        <header>
          <div class="mx-2 my-6 md:mx-8 md:py-6">
            <div class="flex justify-between">
              <div class="flex w-36 md:w-48">
                <div class="flex">
                    <box-icon size="46px" type='solid' name='magnet'></box-icon>
                </div>
                <p class="flex items-center font-mono text-3xl font-extrabold">Electric</p>
              </div>
              <div class="flex mr-4 my-6 md:mr-8 items-center text-sm md:text-lg font-bold md:font-extrabold md:space-x-8 space-x-4">
                <div class="hidden md:block" style="color:#07CAFB">HOME</div>
                <div class="hidden md:block text-black"><a href="/about">ABOUT</a></div>
              </div>
            </div>
          </div>
        </header>
        <div class="none md:bayangan">
        <div class="bg-white mt-24 xl:mt-24 mx-4 md:mx-16 xl:max-w-6xl xl:flex xl:mx-auto">
          <div class="grid md:grid-cols-2 sm:grid-cols-1">
            <div class="container py-4">
              <div class="flex justify-center mx-6 py-6">
                <div class="hidden w-16 xl:w-24 md:w-24 md:block">
                </div>
              </div>
              <div class="flex justify-center">
                <div class="text-xl md:text-xl font-extrabold md:font-bold">
                  <h1>Sign In</h1>
                </div>
              </div>
              <div class="flex justify-center">
              @if(session()->has('gagal'))
              <span class="block text-center text-red-500 sm:inline">{{ session('gagal') }}</span>
              @endif
              </div>
              <div class="flex justify-center px-0 md:px-36 text-center">
                <small style="color:#ACABAB" class="items-center block">if you don't have a account, please paying direcly at at the nearest office</small>
              </div>
              <div class="flex justify-center">
                <form method="POST" action="/">
                    @csrf
                  <div style="border-bottom-width:1px;" class="border-black @error('email') border-red-600 @enderror  mt-8 sm:w-64 md:w-64 flex justify-between mx-auto">
                    <input name="email" class="focus:outline-none w-52 md:w-64" type="text" placeholder="email" autofocus />
                    <div class="@error('email') flex ml-2 items-center text-red-600 @enderror">@error('email')<i class="las la-times"></i>@enderror<i class="las la-envelope"></i></div>
                </div>
                @error('email')<small class="text-red-500">{{ $message }}</small>@enderror
                  <div style="border-bottom-width:1px;" class="border-black @error('password') border-red-600  @enderror mt-8 sm:w-64 md:w-64 flex justify-between mx-auto">
                    <input name="password" class="focus:outline-none w-52 md:w-64" type="password" placeholder="password" />
                    <div class="@error('password') flex ml-2 items-center text-red-600 @enderror">@error('password')<i class="las la-times"></i>@enderror<i class="las la-lock"></i></div>
                </div>
                @error('password')<small class="text-red-500">{{ $message }}</small>@enderror
                  <div class="mt-8 w-64 flex justify-center mb-16">
                    <div>
                      <button type="submit" class="bg-gray-300 hover:bg-gray-400 focus:outline-none text-gray-800 font-extrabold py-2 px-8 rounded  items-center">
                        <i class="las la-sign-in-alt items-center"></i>
                        <span class="ml-2">Sign In</span>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="text-center -mt-12 mb-8">
                <p style="color:#ACABAB" class="">
                  <span class="items-center">Link contact to discuss and problem for registration</span>
                </p>
                <div class="mt-4">
                    <div class="flex justify-center space-x-2 mt-2">
                        <box-icon type='logo' name='whatsapp'></box-icon>
                        <p>+62 898-537-9396</p>
                    </div>
                    <div class="flex justify-center space-x-2 mt-2">
                        <box-icon class="ml-2" name='gmail' type='logo' ></box-icon>
                        <p>mfwj21@gmail.com</p>
                    </div>
                </div>
              </div>
            </div>
            <div style="background: linear-gradient(180deg, rgba(39, 222, 234, 0.96) 0%, rgba(180, 175, 246, 0) 100%);" class="hidden md:block">
              <div class="pt-12 md:pt-24 xl:w-4/5 xl:pt-40"><img src="/img/login.png" alt="" /></div>
            </div>
          </div>
        </div>
    </div>
    </div>
@endsection
