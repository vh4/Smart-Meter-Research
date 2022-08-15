{{-- Dashboard for Engineer --}}
@if(auth()->user()->rules == 'engineer')
<div class="container mx-auto mt-4 md:mt-12">
	<!--Container for table -->
	<div class="container w-full md:w-4/5 xl:w-full mx-auto px-4 md:px-0">
		<!--Card table-->
        <!-- Card Table Serial Number-->
		<div id='recipients' class="p-8 mt-2 lg:mt-0 rounded shadow font-serif">
            <div class="mb-8">
                <div class="flex justify-start space-x-4">
                    <div class="relative">
                        <form method="POST" action="/dashboard/serialnumber">
                            @csrf
                            <input type="text" name="engineer_id" value="{{ auth()->user()->user_id }}" hidden>
                            <input type="number" name="nomorserial" hidden>
                            <button type="submit" class="py-1 px-4 text-blue-400 outline-none outline-1 outline-blue-400 focus:outline-blue-400 text-center md:text-left rounded">Generate Serial Number</button>
                        </form>
                        <div class="md:flex md:justify-start md:space-x-2 mt-2 font-mono">
                            @if (session('success'))
                                <p class="text-blue-400">Your serial number is: <p class="font-semibold"> {{ session('success') }}</p></p>
                             @endif
                            @if (session('failed'))
                                <p class="text-red-400">{{ session('failed') }}</p>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
			<table id="datatabel" class="stripe hover text-slate-500" style="width:100%;">
				<thead>
					<tr>
						<th data-priority="1">No</th>
                        <th data-priority="2">Name</th>
						<th data-priority="2">Serial Number</th>
						<th data-priority="3">Rules</th>
                        <th data-priority="4">Date</th>
						<th data-priority="4">Status</th>
					</tr>
				</thead>
				<tbody>
				    <?php $i=0; ?>
                    @foreach($data_alats_engginer_daftarkan as $x)
                    <?php $i = $i + 1; ?>
                    <tr class="text-center">
						<td class="">{{ $i; }}</td>
                        <td>{{ $x->user->username }}</td>
						<td class="font-mono">{{ $x->nomorserial }}</td>
						<td>{{ $x->user->rules }}</td>
                        <td>{{ Date("Y, d M  H:i:s", strtotime($x->tanggal)) }}</td>
                        <td><a href="/dashboard/serialnumber/delete/{{$x->alat_id}}"><i class="bx bxs-trash text-red-500"></i></a></td>
					</tr>
                    @endforeach
				</tbody>
			</table>
		</div>
        <!-- end Card table-->
	</div>
    <!-- end container for table -->
</div>
    @endif
<!-- end dashboard for engineer -->
