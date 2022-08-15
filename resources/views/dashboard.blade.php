@extends('layouts.dashboard')
@section('dashboard')

<!-- User -->
@include('user.dashboard')
<!-- End User -->

<!-- Engineer -->
@include('engineer.dashboard')
<!-- End Engineer -->

<!-- Dashboard for admin -->
@include('admin.dashboard')
<!-- End Table mobile admin dashboard -->

<!-- Grafik -->
@include('grafik.dashboard')
<!-- End Grafik -->

@endsection
