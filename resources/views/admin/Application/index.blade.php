@extends('layouts.admin.master')

@section('title'){{ __('All user')}}
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">


<style>
	button, input[type="submit"], input[type="reset"] {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
}
a{   
	 cursor: pointer;
	display: block;

}
</style>

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

	@can('app-list') 
	<div class="container-fluid">
	    <div class="row">
	        <!-- Zero Configuration  Starts-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>{{ __('all application')}} </h5>
						@can('app-create') 
	                   	<a href="{{ route('app.create') }}" class="btn btn-pill btn-success-gradien " 
						style="float: right"
						type="button">{{ __('create application')}}</a>
						@endcan
					</div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>{{ __('Name')}}</th>
										<th>{{ __('domain') }}</th>
	                                    <th>{{ __('ip') }}</th>
	                                    <th>{{ __('img') }}</th>
	                                    <th>{{ __('note') }}</th>
	                                    <th>{{ __('category') }}</th>
	                                    <th>{{ __('status') }}</th>
	                                    <th>{{ __('statistics') }}</th>
	                                    <th>{{ __('more') }}</th>
	                                
	                                </tr>
	                            </thead>
	                            <tbody>
									@foreach ($allApplication as $application)
									<tr>
	                                    <td>{{  $application->name }}</td>
	                                    <td>{{  $application->domain }}</td>
	                                    <td>{{  $application->ip }}</td>
	                                    <td><img src="{{ asset('img') }}/{{ $application->img }}"
											width=" 150px" alt=""></td>
	                                    <td>{{  $application->note }}</td>
	                                    <td>{{  $application->categoryR->name }}</td>
	                                    <td>@if($application->status == 1) {{ __('Active')}} @else {{ __('unActive')}} @endif</td>
	                                @php
									$op=	DB::table('hosts')->where('name',$application->domain)
									->where('ip',$application->ip)->first();
									@endphp
									@if($op)
									<td>
										<a data-id="{{ $op->id }}" class="getCheck "
											data-url="{{ URL::to('api/monitor/getCheck')  }}"
											data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
											{{ __('statistics')}} 
											<i class="fa fa-bar-chart-o"></i> 
											</a>
											<a  class="getCheck "alt="Girl in a jacket"
												data-url="{{ URL::to('api/monitor/UserOnline')  }}"
												data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
												{{ __('UsersOnline')}} 
												<i class="fa fa-group"  ></i> 

												</a>

												<a  class="getCheck "
												data-url="{{ URL::to('api/monitor/CheckRun')  }}"
												data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
												{{ __('CheckWebSite')}} 
												<i class="fa fa-ban"></i>

												</a>

									</td>
									@else
											<td></td>
									@endif
								
										<td>
											@can('app-edit') 
											<a href="{{ route('app.edit',$application->id) }}" class="text-muted">
											<i class="fa fa-edit"></i>
											</a>
											@endcan

											@can('app-delete') 
											<a class="confirmDelete"
											data-action="/dashboard/app/"
											data-id="{{ $application->id }}"
											   href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
						  @endcan
											{{-- {!! Form::open(['method' => 'DELETE','route' => ['app.destroy', $application->id],'style'=>'display:inline']) !!}
										<button type="submit" style="border:none;">	<i class="fa fa-trash-o"></i></button>
										{!! Form::close() !!} --}}
										  </td> 
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
  
            <div class="card-body btn-showcase">
                <!-- Large modal-->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">show statistics</h4>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
							
							</div>
                        </div>
                    </div>
                </div>
            </div>
   
@endcan
			 		
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>


<script>

	

	
$(document).on('click', '.getCheck', function (ev) {
            var id =  $(this).data('id');
            var action =  $(this).data('url');
			var url;
			$('.modal-body').empty();
			if (id != undefined) {
				 url = action + "/" + id;	
			}else{  url = action ;}

            $.ajax({
                url: url,
                type: "get",
                contentType: 'application/json',
                success: function (data) {
					$('.modal-body').append(data);
				
								$("span.pie").peity("pie")
       console.log(data);
                },
                error: function (xhr) {

                }
            });

        });

</script>

<script src="{{ asset('assets/js/chart/peity-chart/peity.jquery.js') }}"></script>
<script src="{{ asset('assets/js/chart/peity-chart/peity-custom.js') }}"></script>
@endpush

@endsection