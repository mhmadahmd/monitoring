@extends('layouts.admin.master')

@section('title'){{ __('All user')}}
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
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
	                    <h5>{{ __('all user')}} </h5>
	                   	<a href="{{ route('users.create') }}" class="btn btn-pill btn-success-gradien " 
						style="float: right"
						type="button">{{ __('create user')}}</a>

					</div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>{{ __('Name')}}</th>
	                                    <th>{{__('email')}} </th>
	                                    <th>{{ __('address')}}</th>
	                                    <th>{{ __('birthday')}}</th>
										<th>{{ __('Role')}}</th>
										<th>{{ __('status')}}</th>
	                                    <th>{{ __('more')}}</th>
	                                </tr>
	                            </thead>
	                            <tbody>
									@foreach ($allUser as $user)
									<tr>
	                                    <td>{{  $user->name }}</td>
	                                    <td>{{  $user->email  }}</td>
	                                    <td>{{  $user->address }}</td>
	                                    <td>{{  $user->birthday }}</td>
										<td>
											@if(!empty($user->getRoleNames()))
											  @foreach($user->getRoleNames() as $v)
												 <label class="badge badge-success">{{ $v }}</label>
											  @endforeach
											@endif
										  </td>
										  <td>
											<div class="media">
												<label class="col-form-label m-r-10">@if($user->account_status == 'true') {{ __('Active')}} @else {{ __('unActive')}} @endif</label>
												<div class="media-body text-end icon-state">
												  <label class="switch">
													<input type="checkbox" id="my_checkbox"@if($user->account_status == 'true') checked="checked" @endif class="changeStatus" data-id="{{  $user->id }}"><span class="switch-state"></span>
												  </label>
												</div>
											  </div>
										  </td>
	                                 
										<td>
											<a href="{{ route('users.edit',$user->id) }}" class="text-muted">
											<i class="fa fa-edit"></i>
											</a>
											
											{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
										<button type="submit" style="border:none;">	<i class="fa fa-trash-o"></i></button>
											
												
										{!! Form::close() !!}
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

	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

	<script>
		$('.changeStatus').on('change.bootstrapSwitch', function(e) {

            var id = $(this).data('id');
            var stat =e.target.checked;

            var url = "{{ URL::to('dashboard/changeStatus') }}/" +id+"/"+stat;
       
            $.ajax({
                url: url,
                type: "get",
                contentType: 'application/json',
                success: function(respon) {
					
					const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        if (respon.status === 0) {
            Toast.fire({
                type: 'success',
                title: respon.message
            })
        }
		if (respon.status === 1) {
            Toast.fire({
                type: 'error',
                title: respon.message
            })
        }
		if (respon.reload) {
            window.location.reload();
        }
              
                },
            });

        });
    </script>
	@endpush

@endsection