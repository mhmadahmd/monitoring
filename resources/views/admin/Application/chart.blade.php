@extends('layouts.admin.master')

@section('title'){{ __('All user')}}
 {{ $title }}
@endsection


@section('content')

@php
$op=url('api/monitor/getCheck',1);
// dd($op);
@endphp
	<div class="container-fluid">
		<div class="row">
			
		
	
			<div class="col-xl-6 box-col-6">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Pie Chart 1</h5>
					</div>
					<div class="card-body peity-charts"><span class="pie" data-peity='{ "fill": ["#24695c", "#ba895d"]}'>30,80</span></div>
				</div>
			</div>
			<div class="col-xl-6 box-col-6">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Pie Chart 2</h5>
					</div>
					<div class="card-body peity-charts"><span class="pie" data-peity='{ "fill": ["#24695c", "#ba895d"]}'>1,2,3,2,2</span></div>
				</div>
			</div>
			
		
		</div>
	</div>

			 		
@push('scripts')
<script src="{{ asset('assets/js/chart/peity-chart/peity.jquery.js') }}"></script>
<script src="{{ asset('assets/js/chart/peity-chart/peity-custom.js') }}"></script>
@endpush

@endsection