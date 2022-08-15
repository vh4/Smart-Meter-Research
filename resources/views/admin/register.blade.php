@extends('layouts.dashboard')
@section('dashboard')
    <div class="bmt:0 md:mt-12 mx-4 md:mx-16 xl:w-1/2 xl:mx-auto">
        <div class="container py-4">
            <div class="flex justify-center font-bold">
                <div class="text-xl text-blue-300 md:text-3xl">
                    <h1>Form Registration</h1>
                </div>
            </div>
            <div class="md:hidden flex justify-center mt-2">
                <a href="/" style="color:#ACABAB" class="">
                    <i class="las la-arrow-left"></i>
                    <span class="items-center">Back to Dashboard</span>
                </a>
            </div>
            <div class="flex justify-center">
                <form method="POST" action="/dashboard/register">
                    @csrf
                    <div class="grid grid-cols-4 gap-4 max-w-xl">
                            <div class="relative text-sm text-slate-500 mt-8 col-span-2">
                                <div class="flex justify-between">
                                    <i class="absolute las la-user mt-3 ml-2 text-lg"></i>
                                    <input name="username" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('username') border-red-600 @enderror" type="text" placeholder="Name" value="{{ old('username') }}" />
                                    <div class=" @error('username') flex ml-2 items-center text-red-600 @enderror">
                                        @error('username')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('username')<small class="text-red-500">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative text-sm text-slate-500 mt-8 col-span-2">
                                <div class="flex justify-between">
                                    <i class="absolute las la-envelope mt-3 ml-2 text-lg"></i>
                                    <input name="email" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('email') border-red-600 @enderror" type="email" placeholder="Email" value="{{ old('email') }}" />
                                    <div class=" @error('email') flex ml-2 items-center text-red-600 @enderror">
                                        @error('email')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('email')<small class="text-red-500">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative text-sm text-slate-500 mt-8 col-span-4">
                                <div class="flex justify-between">
                                    <i class="absolute las la-lock mt-3 ml-2 text-lg"></i>
                                    <input name="password" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('password') border-red-600 @enderror" type="password" placeholder="*********************" value="{{ old('password') }}" />
                                    <div class=" @error('password') flex ml-2 items-center text-red-600 @enderror">
                                        @error('password')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('password')<small class="text-red-500">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative col-span-4 text-sm text-slate-500 mt-8">
                                <div class="flex justify-between">
                                    <i class="absolute las la-phone mt-3 ml-2 text-lg"></i>
                                    <input name="nomer" class="w-full border py-2 focus:bg-white focus:border-gray-500 focus:outline-none pl-8 @error('nomer') border-red-600 @enderror " type="number" placeholder="Phone Number" value="{{ old('nomer') }}" />
                                    <div class=" @error('nomer') flex ml-2 items-center text-red-600 @enderror">
                                        @error('nomer')
                                        <i class="las la-times"></i>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @error('nomer')<small class="text-red-500">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="relative text-sm text-slate-500 mt-8 col-span-2">
                                <select name="rules" class="form-select px-3 py-2 font-normal bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-slate-500 focus:bg-white focus:border-blue-600 focus:outline-none">
                                    <option value="engineer">Engineer</option>
                                </select>
                            </div>
                        </div>
                        @if(session()->has('error'))
                        <div class="flex justify-start mt-2">
                        <div class="bg-red-100 text-red-700 px-2 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="grid justify-items-center mt-12">
                        <button type="submit" class="bg-blue-200 text-white hover:bg-blue-300 focus:outline-none font-extrabold py-2 px-12 rounded inline-flex items-center focus:bg-blue-300 active:outline-blue-300"><span class="ml-">SUBMIT</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
