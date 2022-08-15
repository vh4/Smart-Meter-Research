@extends('layouts.app')
@section('container')
<div class="mx-auto w-full mt-32 md:mt-0 md:h-screen flex justify-center items-center">
    <div class="w-1/2 mx-auto">
        <div class="absolute bottom-0 left-0 transform w-full -z-10">
            <img class="relative" src="/img/225.png"  alt="">
        </div>
        <div class="container">
            <div class="container mx-auto w-full md:w-1/2 ">
                <h1 class="text-center text-blue-200 text-2xl mb-8 font-bold">New Password</h1>
                <form method="POST" action="/forgot/{{$user->email}}/{{$token}}">
                    @csrf
                    <input type="number" name="user_id" value="{{$user->user_id}}" hidden>
                    <div class="flex justify-center space-x-2">
                        <div class="flex space-x-2 font-bold text-xl">
                            <input style="width: 16rem;" name="email" id="email" type="email" class="border text-gray-400 bg-blue-50 outline-none pl-2 text-sm py-2 " value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="flex justify-center space-x-2 mt-8">
                        <div class="flex space-x-2 font-bold text-xl">
                            <input style="width: 16rem;" name="password" id="password" type="password" placeholder="*****************" class="border pl-2 text-sm focus:border-black outline-none py-2 ">
                        </div>
                    </div>
                    @error('password')<small class="block text-center text-red-500">{{ $message }}</small>@enderror
                    <div class="flex justify-center mt-8">
                        <button type="submit" style="background-color: rgb(219 234 254);" class="text-center bg-blue-200 rounded py-2 text-white hover:bg-blue-500 focus:outline-none font-bold px-8 focus:bg-blue-300 active:outline-blue-300"><span class="">SUBMIT</span></button>
                    </div>
                </form>
                <div class="flex justify-end mb-10 mt-6 text-blue-300">
                    <a href="/"  class="">
                        <span class="items-center ">kembali ke Login</span>
                  <i class="las la-arrow-right"></i>
                </a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
