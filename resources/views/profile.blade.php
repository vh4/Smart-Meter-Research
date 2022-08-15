@extends('layouts.dashboard')
@section('dashboard')
<div class="container mx-auto mt-4 mb-12">
    <div class="md:hidden flex justify-center mb-4 mt-6">
        <a href="/" style="color:#ACABAB" class="">
            <i class="las la-arrow-left"></i>
          <span class="items-center">Back to Dashboard</span>
        </a>
      </div>
    <div class="mx-8 md:mx-0 rounded-lg">
        @error('gambar')<small class="text-red-500 mr-10">{{ $message }}</small>@enderror
        <div class="flex justify-center">
        <form class="w-full max-w-lg rounded-sm" method="POST" action="/dashboard/profile/{{ $user->user_id }}" enctype="multipart/form-data">
          @csrf
            <div class="flex justify-center pt-6 ml-4 md:ml-0 ">
                <label class="flex cursor-pointer" for="gambar">
                  <img class="max-w-full h-auto rounded-full" src="/img/{{ $user->gambar }}" height="100px" width="100px" alt="" />
                    <i class="las la-edit text-3xl"></i>
                </label>`
            </div>
            @if(session()->has('success'))
            <div class="flex justify-center mt-2 mb-2">
                <div class="bg-green-100 flex space-x-2 text-green-700 px-8 py-3 rounded relative" role="alert">
                    <i class="las la-check-circle text-2xl"></i>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
            @endif
            <div class="flex flex-wrap mt-8 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-slate-500 text-xs font-bold mb-2" for="grid-first-name">
                  Full Name
                </label>
                <input name="username" class="text-sm text-slate-500 appearance-none block w-full border @error('username') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-first-name" type="text"  value="{{ $user->username }}">
                @error('username')<p class="text-red-500 text-xs ">{{ $message }}</p>@enderror
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-slate-500 text-xs font-bold mb-2" for="grid-last-name">
                  Email
                </label>
                <input name="email" class="appearance-none block w-full text-sm text-slate-500 border @error('email') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="email" value="{{ $user->email }}">
                @error('email')<p class="text-red-500 text-xs ">{{ $message }}</p>@enderror
            </div>
            </div>
            <div class="flex flex-wrap mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-slate-500 text-xs font-bold mb-2" for="grid-password">
                  Password
                </label>
                <!-- jangan digantu ya bro plz !. jgn di rusak ! -->
                <input name="password" class="appearance-none block w-full text-sm text-slate-500 border @error('password') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" value="{{ $user->password }}">
                @error('password')<p class="text-red-500 text-xs ">{{ $message }}</p>@enderror
              </div>
            </div>
            <div class="flex flex-wrap mb-2">
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-slate-500 text-xs font-bold mb-2" for="grid-state">
                  Status
                </label>
                <div>
                  <select name="rules" class="form-select text-sm text-slate-500 py-3 px-4 pr-8 font-normal bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 focus:text-slate-500 focus:bg-white focus:border-blue-600 focus:outline-none" id="grid-state">
                    <option value="{{ $user->rules }}">{{ $user->rules }}</option>
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-sm text-slate-500">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
                </div>
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-slate-500 text-xs font-bold mb-2" for="grid-zip">
                  Phone Number
                </label>
                <input name="nomer" class="appearance-none block w-full text-sm text-slate-500 border @error('nomer') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" value="{{ $user->nomer }}">
                @error('nomer')<p class="text-red-500 text-xs ">{{ $message }}</p>@enderror
            </div>
            </div>
            <input type="file" id="gambar" name="gambar" class="hidden">
            <div class="flex flex-wrap mt-4 md:mt-12 justify-center">
              <button type="submit" class="shadow bg-slate-400 hover:bg-slate-400 focus:bg-slate-500 active:outline-slate-300 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-12 rounded" type="button">
                Submit
              </button>
            </div>
          </div>
          </form>
      </div>
</div>
@endsection
