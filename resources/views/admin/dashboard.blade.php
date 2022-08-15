@if(auth()->user()->rules == 'admin')
<!--Container for data -->
<div class="container mt-4 w-full md:w-4/5 xl:w-full mx-auto">
	<div class="px-6">
		<div class="grid-cols-none md:grid gap-12 grid-row-2 mt-0 md:mt-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
            <!-- header verify  -->
			<div class="relative py-4 p-6 pt-2 bg-white shadow-sm rounded-lg">
				<div class="relative">
                    <div class="flex space-x-2">
                        <i class="las la-tasks text-3xl"></i>
                        <p class="mb-8 text-xl font-medium">List Tools</p>
                    </div>
					<div class="flex justify-start">
						<canvas id="myChart" style="width:100%;max-width:400px;max-height:600px"></canvas>
					</div>
				</div>
				<div class="mt-6">
					<p class="mt-4 text-md font-medium text-center">Tools that are not yet user</p>
					<p class="mt-4 text-center text-3xl font-bold"> <i class="bx bxs-user text-3xl font-bold"></i>{{ $total_alat_jadi_yang_belum_ada_user }} </p>
				</div>
			</div>
            <!-- end header verify  -->
            <!-- Total Alat for admin responsive Tablet -->
			<div class="hidden md:block xl:hidden py-4 p-6 pt-2 h-48 bg-white md:shadow-sm">
				<div class="flex justify-between">
					<div class="flex space-x-2">
                        <i class="las la-registered text-3xl"></i>
						<p class="mb-8 text-xl font-medium ">Total Keseluruhan Alat</p>
					</div>
				</div>
				<div class="flex justify-center space-x-2">
					<div>
                        <p class=""><i class="bx bxs-user"></i></p>

					</div>
					<div>
						<p class="text-xl font-medium items-center align-middle
						">{{ $total_alat_jadi }}</p>
					</div>
				</div>
			</div>
            <!-- End total alat untuk tablet responsive  -->
            <!-- Table data -->
			<div class="hidden md:block relative row-span-2 col-span-1 md:col-span-2 grid-cols-4 py-4 p-6 shadow-sm pt-2 rounded-lg">
				<div class="flex justify-between">
                    <div class="flex space-x-2">
                        <i class="las la-table text-3xl"></i>
                        <p class="mb-8 text-xl font-medium">User Table</p>
                    </div>
                    <a href="/dashboard/register">
                        <i class="bx bxs-plus-circle text-3xl"></i>
                    </a>
                </div>
                    <table id="datatabel" class="stripe hover" style="width:100%;">
					<thead>
						<tr>
					        <th data-priority="1">User ID</th>
					        <th data-priority="2">Full Name</th>
					        <th data-priority="3">Phone Number</th>
					        <th data-priority="4">Rules</th>
					        <th data-priority="4">Registered Date</th>
							<th data-priority="3">#</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($pengguna as $x)
						<tr class="text-center">
							<td>{{ $x->user_id }}</td>
							<td>{{ $x->username }}</td>
							<td>{{ $x->nomer }}</td>
							<td>{{ $x->rules }}</td>
							<td>{{ date("d M, Y", strtotime($x->created_at)) }}</td>
							<td><a href="/dashboard/user/delete/{{$x->user_id}}"><i class="bx bxs-trash text-red-500"></i></a></td>
						</tr>
                        @endforeach
                    </tbody>
				</table>
			</div>
            <!-- End Table data -->
            {{-- Desktop for total alat yang sudah jadi --}}
			<div class="sm:block md:hidden xl:block py-4 p-6 pt-2 bg-white shadow-sm rounded-lg">
				<div class="flex justify-between text-center ">
					<div class="flex space-x-2">
                        <i class="las la-registered text-3xl"></i>
						<p class="mb-8 text-xl font-medium ">Total Tools</p>
					</div>
				</div>
				<div class="flex justify-center mt-8 space-x-2">
					<div>
						<p class="text-3xl font-bold"><i class="bx bxs-user"></i></p>
					</div>
					<div>
						<p class="text-3xl font-bold items-center align-middle">{{ $total_alat_jadi }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Dashboard for admin -->
<!-- Table mobile admin dashboard -->
<div class="block md:hidden">
	<div class="container mt-8 rounded-lg w-11/12 mx-auto px-4 md:hidden bg-white font-serif">
		<div class="flex space-x-2 justify-between">
            <div class="flex space-x-2">
                <i class="las la-table text-3xl"></i>
                <p class="block text-xl font-medium">Users Table</p>
            </div>
            <a class="block -mt-1 md:hidden" href="/dashboard/register"><i class="bx bxs-plus-circle text-4xl"></i></a>
        </div>
		<table class="mb-4" id="mobile" class="stripe hover" style="width:100%;">
			<thead>
				<tr>
					<th data-priority="1">User ID</th>
					<th data-priority="2">Full Name</th>
					<th data-priority="3">Rules</th>
					<th data-priority="4">Phone Number</th>
					<th data-priority="5">Registered Date</th>
					<th data-priority="6"></th>
				</tr>
			</thead>
			<tbody> @foreach($pengguna as $x)
				<tr class="text-center">
					<td>{{ $x->user_id }}</td>
					<td>{{ $x->username }}</td>
					<td>{{ $x->rules }}</td>
					<td>{{ $x->nomer }}</td>
					<td>{{ date("d M, Y", strtotime($x->created_at)) }}</td>
					<td><a href="/dashboard/user/delete/{{$x->user_id}}"><i class="bx bxs-trash text-red-500"></i></a></td>
				</tr> @endforeach </tbody>
		</table>
	</div>
@endif
