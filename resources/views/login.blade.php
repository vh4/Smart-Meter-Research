@extends('layouts.app')
@section('container')
		<div class="flex h-full md:h-screen mt-48 md:mt-0 justify-center items-center border-none md:border border-gray-100 shadow-none md:shadow-sm rounded mx-4 md:mx-16 xl:max-w-6xl xl:flex xl:mx-auto">
            <div class="block md:hidden absolute top-24 left-1/2 transform -translate-x-1/2 -z-10">
                <img class="relative" width="70px" src="https://www.pngkey.com/png/full/334-3345717_magnet-comments-magnet-icon-png.png"  alt="">
            </div>
            <div class="grid md:grid-cols-2 sm:grid-cols-1">
				<div class="container py-4">
                    <div class="block md:flex md:justify-center md:mx-6 md:py-6">
					</div>
					<div class="flex justify-center text-blue-400">
						<div class="text-xl md:text-xl font-extrabold md:font-bold">
							<h1>Form Login</h1> </div>
					</div>
					<div class="flex justify-center">
						<form method="POST" action="/"> @csrf
							<div style="border-width:1px;" class="bg-white py-2 px-2 @error('email') border-red-300 @enderror  mt-8 sm:w-64 md:w-64 flex justify-between mx-auto">
								<input name="email" class="focus:outline-none w-52 md:w-64" type="text" placeholder="email address" autofocus />
								<div class="@error('email') flex ml-2 items-center text-red-300 @enderror">@error('email')<i class="las la-times"></i>@enderror<i class="las la-envelope text-gray-300"></i></div>
							</div> @error('email')<small class="text-red-300">{{ $message }}</small>@enderror
							<div style="border-width:1px;" class="bg-white py-2 px-2 @error('password') border-red-300  @enderror mt-8 sm:w-64 md:w-64 flex justify-between mx-auto">
								<input name="password" class="focus:outline-none w-52 md:w-64" type="password" placeholder="password" />
								<div class="@error('password') flex ml-2 items-center text-red-300 @enderror">@error('password')<i class="las la-times"></i>@enderror<i class="las la-lock text-gray-300"></i></div>
							</div> @error('password')<small class="text-red-300">{{ $message }}</small>@enderror
                            <div class="mt-4 flex justify-end text-blue-200">
                                <p><a href="/forgot">forget password ?</a></p>
                            </div>
							<div class="mt-8 w-64 flex justify-center ">
								<div>
									<button type="submit" class="bg-blue-400 hover:bg-blue-400 focus:outline-none text-white font-extrabold py-2 px-8 rounded items-center focus:bg-blue-400 active:outline-blue-500"><span class="ml-2">Sign In</span> </button>
								</div>
							</div>
						</form>
					</div>
					<div class="text-center mt-4">
						<p style="color:#ACABAB" class=""><span class="items-center">if you don't have account ? please</span><a href="/register"><span class="text-blue-400"> register</a></span></p>

					</div>
				</div>
				<div class="hidden md:block bg-blue-50">
					<div class=""><img src="/img/5.svg" alt="" /></div>
				</div>
			</div>
</div>
@endsection
