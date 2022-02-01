@extends('layouts.dashboard')
@section('dashboard')
<style>
.menu-toggle{
    display: flex;
    flex-direction: column;
    height: 20px;
    justify-content: space-between;
    position: relative;
}

.menu-toggle input {
    position: absolute;
    width: 40px;
    height: 28px;
    left: -8px;
    top: -3px;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}
.menu-toggle span{
    display: block;
    width: 28px;
    height: 3px;
    background-color: black;
    border-radius: 3px;
    transition: all ease 0.5s;
}

.menu-toggle span:nth-child(2){
    transform-origin: 0 0;     /* biar poros putaranya diawal sumbu x =0. y=0 tidak ditengah2 garis lurus */
}

.menu-toggle span:nth-child(4){
    transform-origin: 0 100%;     /* biar poros putaranya diawal sumbu x =0. y=0 tidak ditengah2 garis lurus */
}

.menu-toggle input:checked ~ span:nth-child(2){
    transform: rotate(45deg) translate(-1px, -1px);
}

.menu-toggle input:checked ~ span:nth-child(4){
    transform: rotate(-45deg) translate(-1px, 0px);
}

.menu-toggle input:checked ~ span:nth-child(3){
    transform: scale(0);
}
</style>                                                                   {{-- untuk tampilan user --}}
@if(auth()->user()->rules == 'user')
<div class="container mx-auto mt-0 md:mt-12">
    <div class="px-6 py-3 font-bold">
        <h1 class="md:text-2xl md:font-bold text-xl text-white md:text-black">Isi, Pulsa</h1>
        <div class="flex mt-2 justify-start space-x-4">
            <div class="relative">
                <form method="POST" action="/dashboard">
                    @csrf
                <div class="flex bg-white space-x-4">
                    <div class="py-1 font-serif md:py-2 pt-2 text-white bg-white border-b-0 md:border-b-2 md:shadow-sm ">
                        <input class="flex pl-2 placeholder-gray-400 bg-white text-blue-500 md:text-gray-400 focus:outline-none w-52 md:w-64 justify-end" type="text" name="token" placeholder="Masukan 20 digit token" value="{{ old('token') }}">
                    </div>
                    <button type="submit" class="flex items-center shadow-none md:shadow-sm bg-none bg-blue-300 md:bg-white dark:bg-gray-800 ">
                      <i class="las la-sync-alt ml-2 md:ml-0 font-extrabold text-2xl text-white md:text-gray-400 hover:text-blue-300"></i>
                    </button>
                </div>
                </form>
                @error('token')<small class="text-red-500">{{ $message }}</small>@enderror
                @if(session()->has('success'))
                <div class="flex mt-4 font-mono !">
                  <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    </span>
                  </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <svg class="block md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FFFFFF" fill-opacity="1" d="M0,32L48,80C96,128,192,224,288,245.3C384,267,480,213,576,192C672,171,768,181,864,165.3C960,149,1056,107,1152,101.3C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    <div class="px-6 mx-auto grid bg-white">
    <div class="grid gap-6 mt-0 md:mt-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
        <div class="relative py-4 p-6 pt-2 border-x-2 border-y-2 md:border-y-0 bg-white rounded-lg  dark:bg-gray-800">
          <div class="flex justify-between">
            <div class="relative">
              <p class="mb-8 text-xl md:text-2xl  font-bold dark:text-gray-200">Perkiraan Pulsa Habis</p>
            </div>
          </div>
          <div class="flex justify-between mt-8">
            <div id="sensor">
                @if($data_listrik !== null)
              <p class="text-xl md:text-2xl text-purple-600 font-bold dark:text-gray-200"> {{ $data_listrik->prediksi_pulsa_habis }}</p>
              @else
              <p class="text-xl md:text-2xl  text-purple-600 font-bold dark:text-gray-200">-</p>
              @endif
            </div>
          </div>
        </div>
        <div class="relative py-4 p-6 pt-2 border-x-2 border-y-2 md:border-y-0 bg-white rounded-lg dark:bg-gray-800">
          <div class="flex justify-between">
            <div class="relative">
              <p class="mb-8 text-xl md:text-2xl font-bold dark:text-gray-200">Sisa Pulsa</p>
            </div>
          </div>
          <div class="flex justify-between mt-8">
            <div id="daya_perjam">
                @if($data_listrik !== null)
              <p class="text-xl md:text-2xl  text-pink-600 font-bold dark:text-gray-200">{{ $data_listrik->sisa_pulsa}}</p>
              @else
              <p class="text-xl md:text-2xl  text-pink-600 font-bold dark:text-gray-200">-</p>
                @endif
            </div>
            <div>
              <p class="text-xl md:text-2xl font-bold dark:text-gray-200">Kwh</p>
            </div>
          </div>
        </div>
        <div class="relative py-4 p-6 pt-2 border-x-2 border-y-2 md:border-y-0  bg-white rounded-lg dark:bg-gray-800">
          <div class="flex justify-between">
            <div class="relative">
              <p class="mb-8 text-xl md:text-2xl  font-bold dark:text-gray-200">Penggunaan Hari ini</p>
            </div>
          </div>
          <div class="flex justify-between mt-8">
            <div id="daya_perjam">
             @if($data_listrik !== null)
              <p class="text-xl md:text-2xl  text-green-500 font-bold dark:text-gray-200">{{ $data_listrik->pemakaian_hari_ini }}</p>
              @else
              <p class="text-xl md:text-2xl  text-green-500 font-bold dark:text-gray-200">-</p>
              @endif
            </div>
            <div>
              <p class="text-xl md:text-2xl  font-bold dark:text-gray-200">Kwh</p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex space-x-2 items-center">
      <div class="mt-4">
          <div class="menu-toggle mb-4">
              <input id="tombol" type="checkbox">
            <span></span>
            <span></span>
            <span></span>
          </div>
      </div>
      <div>
    </div>
        <p class="font-bold text-lg md:text-2xl">Perkiraan Pemakaian Kwh 1 Jam Kedepan</p>
      </div>
      <div id="ganti" class="hidden">
      <div class="mt-4 grid gap-6 mt-0 md:mt-6 mb-8 md:grid-cols-2 xl:grid-cols-3 ">
      <div  class="relative  py-4 p-6 pt-2 border-x-2 border-y-2 md:border-y-0  bg-white rounded-lg dark:bg-gray-800">
        <div class="flex justify-between">
          <div class="relative">
            <p class="mb-8 text-xl md:text-2xl  font-bold dark:text-gray-200">ARIMA</p>
          </div>
        </div>
        <div class="flex justify-between mt-8">
          <div id="daya_perjam">
           @if($data_listrik !== null)
            <p class="text-xl md:text-2xl  text-blue-500 font-bold dark:text-gray-200">{{ $data_listrik->pemakaian_hari_ini }}</p>
            @else
            <p class="text-xl md:text-2xl  text-blue-500 font-bold dark:text-gray-200">-</p>
            @endif
          </div>
          <div>
            <p class="text-xl md:text-2xl  font-bold dark:text-gray-200">Kwh</p>
          </div>
        </div>
      </div>
      <div id="lstm" class="relative py-4 p-6 pt-2 border-x-2 border-y-2 md:border-y-0  bg-white rounded-lg dark:bg-gray-800">
        <div class="flex justify-between">
          <div class="relative">
            <p class="mb-8 text-xl md:text-2xl  font-bold dark:text-gray-200">LSTM</p>
          </div>
        </div>
        <div class="flex justify-between mt-8">
          <div id="daya_perjam">
           @if($data_listrik !== null)
            <p class="text-xl md:text-2xl  text-orange-500 font-bold dark:text-gray-200">{{ $data_listrik->pemakaian_hari_ini }}</p>
            @else
            <p class="text-xl md:text-2xl  text-orange-500 font-bold dark:text-gray-200">-</p>
            @endif
          </div>
          <div>
            <p class="text-xl md:text-2xl  font-bold dark:text-gray-200">Kwh</p>
          </div>
        </div>
      </div>
    </div>
    </div>
      <div class="py-3 mt-4 font-bold border-x-2 border-y-2 md:border-y-0 md:border-x-0">
        <h1 class="hidden text-xl md:text-2xl  md:block">Grafik, Prediksi</h1>
    <div class="overflow-x-scroll" id="container"></div>
    </div>
    </div>
  </div>
@endif


                                                                    {{-- untuk tampilan Engineer --}}

@if(auth()->user()->rules == 'engineer')
<svg class="block md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FFFFFF" fill-opacity="1" d="M0,32L48,80C96,128,192,224,288,245.3C384,267,480,213,576,192C672,171,768,181,864,165.3C960,149,1056,107,1152,101.3C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
<div class="container mx-auto mt-0 md:mt-12 bg-white">
    <div class="relative text-center">
        <h1 class="text-3xl">Engineer, Welcome to Dashboard!</h1>
    </div>

	<!--Container-->
	<div class="container w-full md:w-4/5 xl:w-full bg-white mx-auto px-2">
		<!--Card-->
		<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow  font-serif">
			<table id="example" class="stripe hover" style="width:100%;">
				<thead>
					<tr>
						<th data-priority="1">User ID</th>
                        <th data-priority="2">rules</th>
						<th data-priority="2">Alamat</th>
						<th data-priority="3">Nomer</th>
						<th data-priority="4">Status</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($pengguna as $x)
                    @if($x->rules == 'user')
                    <tr class="text-center">
						<td class="font-extrabold text-4xl">{{ $x->user_id }}</td>
                        <td>{{ $x->rules }}</td>
						<td>{{ $x->alamat }}</td>
						<td>{{ $x->nomer }}</td>
                        @if($x->alat_terdaftar == 'belum')
                        <td>
                            <div class="flex text-center">
                                <i class="ml-12 las la-times-circle text-red-400 text-4xl"></i>
                                <a href="/dashboard/verify/{{ $x->user_id }}"><button class="bg-transparent hover:bg-blue-500 text-blue-700 hover:text-white py-1 px-2 border border-green-500 hover:border-transparent rounded">Verify</button></a>
                            </div>
                        </td>
                        @else
						<td><i class='bx bxs-check-circle text-green-400 text-4xl'></i></td>
                        @endif
                        @endif
					</tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endif

{{-- untuk tampilan Engineer --}}

@if(auth()->user()->rules == 'admin')
    <!--Container-->
    <div class="relative text-center">
        <h1 class="text-3xl mt-0 md:mt-12 font-bold text-white md:text-black">Admin, Welcome to Dashboard!</h1>
    </div>
    <svg class="block md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FFFFFF" fill-opacity="1" d="M0,32L48,80C96,128,192,224,288,245.3C384,267,480,213,576,192C672,171,768,181,864,165.3C960,149,1056,107,1152,101.3C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
	<div class="container w-full md:w-4/5 xl:w-full bg-white mx-auto px-2">
        <div class="px-6 mx-auto grid bg-white">
            <div class="grid gap-12 grid-row-2 mt-0 md:mt-6 mb-8 md:grid-cols-2 xl:grid-cols-3 ">
                <div class="relative grid-cols-4 py-4 p-6 pt-2 border-2 rounded-lg  dark:bg-gray-800">
                    <div class="relative">
                        <p class="mb-8 text-xl md:text-4xl font-bold dark:text-gray-200">Total Verify</p>
                        <div class="flex justify-start">
                            <canvas id="myChart" style="width:100%;max-width:400px;max-height:600px"></canvas>
                        </div>
                    </div>
                    <div class="mt-6">
                        <p class="mt-4 text-xl md:text-3xl font-bold dark:text-gray-200">Belum Verify</p>
                        <p class="font-serif mt-4 text-center text-5xl font-bold dark:text-gray-200">
                            <i class="bx bxs-user align-middle text-5xl"></i>{{ $total_not_verify }}
                        </p>
                    </div>
                </div>
                <div class="hidden md:block relative row-span-2 col-span-1 md:col-span-2 grid-cols-4 py-4 p-6 pt-2 border-2 rounded-lg  dark:bg-gray-800">
                    @if(session()->has('success'))
                    <div class="flex justify-center">
                      <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Message!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        </span>
                      </div>
                    </div>
                    @endif
                    @if(session()->has('delete'))
                    <div class="flex mt-4 font-mono !">
                      <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('delete') }}</span>
                        </span>
                      </div>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <p class="mb-8 text-xl md:text-4xl font-bold dark:text-gray-200">Table Users</p>
                        {{-- icon plus desktop link add user  --}}
                        <a href="/dashboard/register/user"><i class="bx bxs-plus-circle text-4xl"></i></a>
                </div>
                    <table id="example" class="stripe hover font-serif" style="width:100%;">
                        <thead>
                            <tr>
                                <th data-priority="1">User ID</th>
                                <th data-priority="2">Full Name</th>
                                <th data-priority="2">Alamat</th>
                                <th data-priority="3">Nomer</th>
                                <th data-priority="3">Rules</th>
                                <th data-priority="3">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengguna as $x)

                            <tr class="text-center">
                                <td>{{ $x->user_id }}</td>
                                <td>{{ $x->username }}</td>
                                <td>{{ $x->alamat }}</td>
                                <td>{{ $x->nomer }}</td>
                                <td>{{ $x->rules }}</td>
                                <td><a href="/dashboard/user/delete/{{$x->user_id}}"><i class="bx bxs-trash text-red-500"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="relative py-4 p-6 pt-2 border-x-2 bg-white rounded-lg dark:bg-gray-800">
                    <div class="flex justify-between">
                      <div class="relative">
                        <p class="mb-8text-xl md:text-4xl font-bold dark:text-gray-200">Total Daftar Alat</p>
                      </div>
                    </div>
                    <div class="flex justify-center mt-8 space-x-2">
                      <div>
                        <p class="text-5xl font-bold dark:text-gray-200"><i class="bx bxs-user"></i></p>
                      </div>
                      <div>
                        <p class="font-serif text-5xl font-bold items-center align-middle dark:text-gray-200">{{ $total_user }}</p>
                      </div>
                    </div>
                  </div>
              </div>
        </div>
	</div>
    {{-- table mobile --}}
    @if(session()->has('success'))
    <div class="flex justify-center">
      <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Message!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        </span>
      </div>
    </div>
    @endif
    @if(session()->has('delete'))
    <div class="flex mt-4 font-mono !">
      <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('delete') }}</span>
        </span>
      </div>
    </div>
    @endif
    <div class="block md:hidden container bg-white font-serif">
    <div class="relative">
            <p class="mb-8 text-center text-xl md:text-4xl font-bold dark:text-gray-200">Table Users
                 {{-- icon plus mobile link add user  --}}
                <a class="block md:hidden" href="/dashboard/register/user"><i class="bx bxs-plus-circle text-4xl"></i></a>
            </p>
    </div>
    <table id="mobile" class="stripe hover" style="width:100%;">
        <thead>
            <tr>
                <th data-priority="1">User ID</th>
                <th data-priority="2">Full Name</th>
                <th data-priority="2">Alamat</th>
                <th data-priority="3">Nomer</th>
                <th data-priority="4">Rules</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengguna as $x)
            <tr class="text-center">
                <td>{{ $x->user_id }}</td>
                <td>{{ $x->username }}</td>
                <td>{{ $x->alamat }}</td>
                <td>{{ $x->nomer }}</td>
                <td>{{ $x->rules }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>

//verify and not verify
var verify = '<?php echo $total_verify ?>'
var not_verify = '<?php echo $total_not_verify ?>'

// chart js
var xValues = ["Verify", "Belum Verify"];
var yValues = [verify, not_verify];
var barColors = [
    'rgb(255, 99, 132)',
    'rgb(54, 162, 235)',
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Chart total alat yang telah di verify atau tidak oleh engineer"
    },
    responsive: true,
    legend: {
        position: 'right',
        labels: {
        fontColor: "black",
        padding: 20,
        }
    }
  }
});

// mobile table data js
$(document).ready(function() {

var table = $('#mobile').DataTable({
        responsive: true
    })
    .columns.adjust()
    .responsive.recalc();
});

</script>
<script>
//================================================================================================

// jquery datatables
$(document).ready(function() {

var table = $('#example').DataTable({
        responsive: true
    })
    .columns.adjust()
    .responsive.recalc();
});

//================================================================================================

//actual
var actual = '<?php echo $final_actual[0] ?>' // $final_actual[0] => [[]] menjadi []
actual = JSON.parse(actual)

//arima
var arima = '<?php echo $final_arima[0] ?>'
arima = JSON.parse(arima)

//lstm
var lstm = '<?php echo $final_lstm[0] ?>'
lstm = JSON.parse(lstm)

Highcharts.chart('container', {
  chart: {
    type: 'spline'
  },
  title: {
    text: ''
  },
  subtitle: {
    text: 'Time series data prediksi pemakaian energi listrik (kWh)'
  },
  xAxis: {
    type: 'datetime',
    dateTimeLabelFormats: { // don't display the dummy year
      month: '%e. %b',
      year: '%b',
      second: '%H:%M:%S',
      minute: '%H:%M',
      hour: '%H:%M',
    },
    title: {
      text: 'Tanggal'
    },
  },
  yAxis: {
    title: {
      text: 'Pemakaian listrik (kWh)'
    },
    min: 0
  },
  tooltip: {
    headerFormat: '<b>{series.name}</b><br>',
    pointFormat: '{point.x:%e. %b.%H:%M:%S}: {point.y:.2f} kWh'
  },

  plotOptions: {
    series: {
      marker: {
        //enabled: true
      }
    }
  },

  colors: ['red', 'green', 'purple', 'blue', 'black'],
  series: [{
    name: "ARIMA",
    data: arima
  }, {
    name: "LSTM",
    data: lstm
  }, {
    name: "Actual",
    data: actual
  }],

  responsive: {
    rules: [{
      condition: {
        maxWidth: 100
      },
      chartOptions: {
        plotOptions: {
          series: {
            marker: {
              radius: 2.5
            }
          }
        }
      }
    }]
  }
});

  </script>
  <script>
      //

//untuk tombol show hidden

var tombol = document.querySelector("#tombol")
var ganti = document.querySelector("#ganti")


tombol.addEventListener('click', function(){
    ganti.classList.toggle("hidden");
})


  </script>
@endsection
