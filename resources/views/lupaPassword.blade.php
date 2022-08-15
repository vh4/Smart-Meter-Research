@extends('layouts.app')
@section('container')
<div class="container w-full md:h-screen mt-64 md:mt-0 flex justify-center items-center mx-auto">
    <div class="absolute left-1/2 transform -translate-y-[90%] -translate-x-1/2 w-52 -z-10">
        <img class="relative" src="/img/forgot.svg"  alt="">
    </div>
    <div class="hidden md:block absolute w-1/2 bottom-0 left-0 -z-10">
        <img class="relative" src="/img/village.svg"  alt="">
    </div>
	<div class="bg-red">
		<div>
			<form action="/forgot" method="POST">
			    @csrf
			    <label class="block text-center font-bold text-2xl text-blue-400">Form Forget Password</label>
				<div class="flex items-center border-b border-blue-300 py-2 mt-4">
					<input name="email" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Email Address" aria-label="Full name">
					<button type="submit" class="flex-shrink-0 outline-none focus:outline-none hover:bg-blue-300 border-blue-400 text-sm border text-blue-400 hover:text-white py-1 px-2 rounded"> Via Email </button>
				</div>
                <div class="flex justify-center mt-4">
                    <a href="/" class="text-blue-400">
                        <i class="las la-arrow-left"></i>
                      <span class="items-center">Back to dashboard</span>
                    </a>
                  </div>
			</form>
		</div>
	</div>
</div> @endsection
