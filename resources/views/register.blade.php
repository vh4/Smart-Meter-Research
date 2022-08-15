@extends('layouts.app')
@section('container')
<div class="container mx-auto mt-20 md:mt-0 md:flex justify-center items-center w-full md:h-screen">
    <div class="fixed bottom-0 left-0 w-full -z-10">
        <img class="relative" src="/img/city.svg"  alt="">
    </div>
    <div class="mx-4">
        <div class="container py-4 md:mt-0">
            <div class="flex justify-center text-blue-400 font-bold">
                <div class="text-2xl md:text-3xl">
                    <h1>Form Registration</h1>
                </div>
            </div>
            @if(session()->has('nomorserial_tidakterdaftar'))
            <div class="flex justify-center text-center mt-2">
                <div class="bg-red-100 text-red-300 px-2 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('nomorserial_tidakterdaftar') }}</span>
                </div>
            </div>
            @endif
            <div class="flex justify-center">
                <form method="POST" action="/register">
                    <div class="flex justify-center mb-4 mt-2">
                        <a href="/"  class="text-blue-400">
                            <i class="las la-arrow-left"></i>
                          <span class="items-center">Back to Dashboard</span>
                        </a>
                      </div>
                    @csrf
                    <div class="grid grid-cols-4 gap-4 max-w-xl">
                            <div class="relative text-gray-700 mt-4 col-span-2">
                                <div class="flex justify-between">
                                    <i class="absolute las la-user mt-3 ml-2 text-lg"></i>
                                    <input name="username" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('username') border-red-300 @enderror" type="text" placeholder="Full Name" value="{{ old('username') }}" />
                                    <div class=" @error('username') flex ml-2 items-center text-red-300 @enderror">
                                        @error('username')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('username')<small class="text-red-300">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative text-gray-700 mt-4 col-span-2">
                                <div class="flex justify-between">
                                    <i class="absolute las la-envelope mt-3 ml-2 text-lg"></i>
                                    <input name="email" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('email') border-red-300 @enderror" type="email" placeholder="Email" value="{{ old('email') }}" />
                                    <div class=" @error('email') flex ml-2 items-center text-red-300 @enderror">
                                        @error('email')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('email')<small class="text-red-300">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative text-gray-700 mt-8 col-span-4">
                                <div class="flex justify-between">
                                    <i class="absolute las la-lock mt-3 ml-2 text-lg"></i>
                                    <input name="password" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('password') border-red-300 @enderror" type="password" placeholder="*********************" value="{{ old('password') }}" />
                                    <div class=" @error('password') flex ml-2 items-center text-red-300 @enderror">
                                        @error('password')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('password')<small class="text-red-300">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative col-span-2 text-gray-700 mt-8">
                                <div class="flex justify-between">
                                    <i class="absolute las la-barcode mt-3 ml-2 text-lg"></i>
                                    <input name="nomorserial" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('nomorserial') border-red-300 @enderror" type="text" placeholder=" Serial Number" value="{{ old('nomorserial') }}" />
                                    <div class=" @error('nomorserial') flex ml-2 items-center text-red-300 @enderror">
                                        @error('nomorserial')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('nomorserial')<small class="text-red-300">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative col-span-2 text-gray-700 mt-8">
                                <div class="flex justify-between">
                                    <i class="absolute las la-phone mt-3 ml-2 text-lg"></i>
                                    <input name="nomer" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('nomer') border-red-300 @enderror " type="number" placeholder="Phone Number" value="{{ old('nomer') }}" />
                                    <div class=" @error('nomer') flex ml-2 items-center text-red-300 @enderror">
                                        @error('nomer')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('nomer')<small class="text-red-300">{{ $message }}</small>@enderror
                                </div>
                            </div>
                                <div>
                                    <input type="text" name="rules" value="user" hidden>
                                </div>
                        </div>
                        @if(session()->has('error'))
                        <div class="flex justify-start mt-2">
                        <div class="bg-red-100 text-red-300 px-2 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    </div>
                    @endif
                        <div class="grid justify-items-center mt-6">
                            <button type="submit" class="bg-blue-400 text-white hover:bg-blue-400 focus:outline-none font-extrabold py-2 px-12 rounded inline-flex items-center focus:bg-blue-400 active:outline-blue-400"><span class="ml-">SUBMIT</span></button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
