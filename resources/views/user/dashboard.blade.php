<!--  menu dashboard for user -->
@if(auth()->user()->rules == 'user')
<div class="mx-auto max-h-screen mt-0 md:mt-4 lg:mt-4 xl:mt-4 2xl:mt-4 mb-24">
    <!-- isi pulsa -->
	<div class="px-6 py-3 font-medium">
        <h1 class="text-md md:text-md md:font-medium text-slate-500">Top Up</h1>
        <div class="flex justify-between items-center">
            <div class="mt-2 space-x-4">
                <div class="flex justify-around items-center space-x-0 md:space-x-12">
                    <form method="POST" action="/dashboard"> @csrf
                        <div class="flex bg-white space-x-4 w-64">
                            <div class="py-1 font-serif md:py-2 pt-2 bg-white border-b-0 md:border-b">
                                <input class="flex pl-2 placeholder-gray-400 md:text-gray-400 focus:outline-none w-52 md:w-64 justify-end" type="number" name="token" placeholder="Enter 20 digit token" value="{{ old('token') }}"> </div>
                            <button type="submit" class="flex justify-end items-center outline-none focus:outline-none bg-white"><i class="las la-arrow-right  font-extrabold text-2xl text-gray-500 hover:text-blue-300"></i> </button>
                        </div>
                    </form>
                    <div id="notifikasi-token" class="items-center">

                    </div>
                </div>
                @error('token')<small class="text-red-500">{{ $message }}</small>@enderror
            </div>
            <div class="hidden md:block p-2 border-l-8 border-blue-400 text-slate-800 bg-blue-50">
                <p class="text-slate-500 text-sm">Welcome to User Dashboard !</p>
            </div>
        </div>
	</div>

    <!-- end isi pulsa -->
    <!-- column and row for data -->
	<div class="">
		<div class="px-8 md:px-6 grid gap-12 mt-0 md:mt-6 mb-8 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
			<div class="relative py-4 p-8 pt-2 shadow-sm shadow-slate-200 rounded-lg border-b-4 border-purple-400">
				<div class="flex justify-between">
					<div>
						<p class="mb-8 text-sm md:text-md text-slate-500">Electricity will run out in</p>
					</div>
                    <div class="flex text-2xl font-bold">
                        <i class="bx bxs-info-circle text-blue-300 relative group">
                            <div class="hidden group-hover:block absolute w-48 h-16 bg-blue-400 top-0 right-6 rounded-lg p-2">
                                <p class="absolute text-xs text-white font-medium">Estimation of the time remaining before the electricity completely depleted.</p>
                            </div>
                        </i>
                    </div>
				</div>
                <div>
					<div class="mb-8" id="sensor">
						<p id="realtime_perkiraan_pulsa_habis" class="text-md md:text-xl text-purple-500 font-medium">-</p>
					</div>
                    <div class="absolute bottom-0 mb-2">
                        <p id="notifikasi_pulsa_akan_habis" class="text-xs text-gray-400"></p>
                    </div>
				</div>
			</div>
			<div class="relative py-4 p-6 pt-2 shadow-sm shadow-slate-200 bg-white rounded-lg border-b-4 border-amber-400">
				<div class="flex justify-between">
					<div class="">
						<p class="mb-8 text-sm md:text-md text-slate-500">Current Electricity Balance</p>
					</div>
                    <div class="flex text-2xl font-bold">
                        <i class="bx bxs-info-circle text-blue-300 relative group">
                            <div class="hidden group-hover:block absolute w-48 h-16 bg-blue-400 top-0 right-6 rounded-lg p-2">
                                <p class="absolute text-xs text-white font-medium">Current electricity balance.</p>
                            </div>
                        </i>
                    </div>
				</div>
				<div>
					<div class="mb-8" id="daya_perjam">
						<p id="realtime_sisa_pulsa" class="text-md md:text-xl text-amber-500 font-medium"><i class="las la-bolt"></i>-</p>
					</div>
                    <div class="absolute bottom-0 mb-2">
                        <p id="update_terakhir_sisa_pulsa" class="text-xs text-gray-400"></p>
                    </div>
				</div>
			</div>
			<div class="relative py-4 p-6 pt-2 shadow-sm shadow-slate-200 bg-white rounded-lg border-b-4 border-emerald-400">
				<div class="flex justify-between">
					<div class="">
						<p class="mb-8 text-sm md:text-md text-slate-500">Average Daily Usage</p>
					</div>
                    <div class="flex text-2xl font-bold">
                        <i class="bx bxs-info-circle text-blue-300 relative group">
                            <div class="hidden group-hover:block absolute w-48 h-16 bg-blue-400 top-0 right-6 rounded-lg p-2">
                                <p class="absolute text-xs text-white font-medium">Average electricity usage for the last 7 days</p>
                            </div>
                        </i>
                    </div>
				</div>
                <div>
					<div class="mb-8" id="daya_perjam">
						<p id="rata_rata_perhari" class="text-md md:text-xl text-green-500 font-medium"><i class="las la-bolt"></i>-</p>
					</div>
                    <div class="absolute bottom-0 mb-2">
                        <p id="pemakaian_hari_ini" class="text-xs text-gray-400"></p>
                    </div>
				</div>
			</div>
            <div class="relative py-4 p-6 pt-2 shadow-sm shadow-pink-200 bg-white rounded-lg border-b-4 border-pink-400">
				<div class="flex justify-between">
					<div class="">
						<p class="mb-8 text-sm md:text-md  text-slate-500">Tomorrow's Usage Forecast</p>
					</div>
                    <div class="flex text-2xl font-bold">
                        <i class="bx bxs-info-circle text-blue-300 relative group">
                            <div class="hidden group-hover:block absolute w-48 h-20 bg-blue-400 top-0 right-6 rounded-lg p-2">
                                <p class="absolute text-xs text-white font-medium">Estimation of electricity usage based on thetomorrow’s electricity usage for the last 1 day.</p>
                            </div>
                        </i>
                    </div>
				</div>
                <div>
					<div class="mb-8" id="daya_perjam">
						<p id="prediksi_satu_hari_kedepan" class="text-md md:text-xl text-pink-500 font-medium"><i class="las la-bolt"></i>-</p>
					</div>
                    <div class="absolute bottom-0 mb-2">
                        <p id="batas_waktu_prediksi" class="text-xs text-gray-400"></p>
                    </div>
				</div>
			</div>
		</div>
        <div class="px-2 grid-cols-none md:grid mt-0 mb-8 md:mb-44 md:grid-cols-12 md:space-x-4">
            <div class="w-full col-span-6 shadow-md shadow-slate-200 p-2 md:p-12 rounded">
                <!-- Grafik Prediksi  -->
                <div class="flex mb-2 md:mb-0 justify-between">
                    <div class="flex items-center space-x-1 ">
                        <i class="bx bx-chart text-slate-500 text-3xl"></i>
                        <h1 class="text-md mt-1 md:text-lg text-slate-500">Electricity Usage Graph</h1>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="flex my-2 space-x-2 ml-10 md:justify-start">
                        <button id="day" class="px-4 border-slate-300 bg-white text-xs py-1 outline-none focus:outline-slate-300 text-slate-400 border font-bold focus:bg-blue-400 focus:text-white focus:outline-none">Day</button>
                        <button id="week" class="px-4 bg-white text-xs py-1 outline-none focus:outline-slate-300 text-slate-400 border border-slate-300 font-bold focus:bg-blue-400 focus:text-white focus:outline-none">Week</button>
                        <button id="all" class="px-4 bg-white text-xs py-1 outline-none focus:outline-slate-300 text-slate-400 border border-slate-300 font-bold focus:bg-blue-400 focus:text-white focus:outline-none">All</button>
                    </div>
                    <div class="my-2 ml-2">
                        <button id="prediction" class="px-4 bg-white text-xs py-1 outline-none focus:outline-slate-300 text-slate-400 border border-slate-300 font-bold focus:bg-blue-400 focus:text-white focus:outline-none">Prediction</button>
                    </div>
                </div>
                <div class="py-3 font-medium shadow-sm shadow-slate-200 bg-white">
                    <div style="width: 100%" id="container"></div>
                </div>
                <!-- End Grafik Prediksi  -->
            </div>
            <div class="col-span-6 shadow-md shadow-slate-200 p-2 md:p-12 rounded">
                <!-- History Token untuk Mobile Tittle  -->
                <div class="flex space-x-1 font-medium mt-8 md:mt-0 mb-4 md:mb-2">
                    <i class="inline-block text-slate-500 items-center bx bx-table text-3xl"></i>
                    <h1 class="text-md mt-1 md:mt-0 md:text-lg text-slate-500">Token History</h1>
                </div>
                <!-- End History Token untuk Mobile Tittle  -->
                <!-- Card table for mobile-->
                <div class="rounded font-sans p-2">
                    <!-- End History Token untuk Desktop Tittle  -->
                    <table width="100%" id="datatabel">
                        <thead>
                            <tr>
                                <th data-priority="2"></th>
                                <th data-priority="2">#</th>
                                <th data-priority="4">Date</th>
                                <th data-priority="3">Token</th>
                            </tr>
                        </thead>
                        <?php $i = 1; ?>
                        <tbody> @foreach($tokenHistory as $tokenHistory)
                            <tr class="text-sm md:text-md text-center">
                                <td class="font-bold text-lg"><?= $i++; ?></td>
                                @if($tokenHistory->status == 'sukses')
                                <td><i class='bx bxs-check-circle text-2xl text-green-400'></i></td>
                                @else
                                <td><i class='bx bxs-x-circle text-2xl text-red-400'></i></td>
                                @endif
                                <td>{{ Date("D, d M", strtotime($tokenHistory->tanggal)) }}</td>
                                <td>{{ $tokenHistory->token }}</td>
                            </tr> @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end Card table for mobile-->
            </div>
        </div>
	</div>
     <!-- Row Data Kolom  -->
</div>

@endif

 <!-- End Menu Dashboard User  -->
