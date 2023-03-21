@extends('layouts.admin.master')

@section('title')Basic Init
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">


@endpush

@section('content')
	{{-- @component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Basic DataTables</h3>
		@endslot
		<li class="breadcrumb-item">Tables</li>
		<li class="breadcrumb-item">Data Tables</li>
		<li class="breadcrumb-item active">Basic Init</li>
	@endcomponent --}}
	@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
	
	<div class="container-fluid">
	    <div class="row">
	        <!-- Zero Configuration  Starts-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>activity user </h5>
	                  

					</div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>log_name</th>
	                                    <th>description </th>
	                                    <th>subject_type</th>
	                                    <th>causer</th>
	                                    {{-- <th>causer</th> --}}
	                                    <th>event</th>
	                                    <th>Created</th>
									
	                                </tr>
	                            </thead>
	                            <tbody>
				
									@foreach ($activities as $activity)
									<tr>
								
	                                    <td>{{  $activity->log_name }}</td>
	                                    <td>{{  $activity->description  }}</td>
	                                    <td>{{  $activity->subject_type }}</td>
	                                    <td>{{  $activity->causer->name }}</td>
										{{-- 									
										<td>
										@foreach ($activity->properties['attributes'] as $key => $value)
										<div>New {{ $key }}: {{ $value }}</div>
										<div>New {{ $key }}: {{ isset( $activity->properties['attributes'])? $activity->properties['attributes'] [$key] : ''}}</div>
										<div>Original {{ $key }}: {{ isset( $activity->properties['old'])? $activity->properties['old'] [$key] : ''}}
									@endforeach
									<td> --}}
	                                    <td>
											<pre>{{ $activity->properties  }}</pre></td>
	                                    <td>{{  $activity->event }}</td>
	                                    <td>{{  $activity->created_at }}</td>
							
	                                </tr>
									@endforeach
	                             
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>

	    </div>
	</div>

	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>


	@endpush

@endsection