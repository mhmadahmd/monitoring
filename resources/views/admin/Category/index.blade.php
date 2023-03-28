@extends('layouts.admin.master')

@section('title'){{ __('All category')}}
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

	@can('category-list') 
	<div class="container-fluid">
	    <div class="row">
	        <!-- Zero Configuration  Starts-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>{{ __('all category')}} </h5>
						@can('category-create') 
	                   	<a href="{{ route('category.create') }}" class="btn btn-pill btn-success-gradien " 
						style="float: right"
						type="button">{{ __('create category')}}</a>
						@endcan

					</div>
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>{{ __('Name')}}</th>
	                                
	                                </tr>
	                            </thead>
	                            <tbody>
									@foreach ($allcategory as $category)
									<tr>
	                                    <td>{{  $category->name }}</td>
	                                
									
										<td>
											@can('category-edit') 
											<a href="{{ route('category.edit',$category->id) }}" class="text-muted">
											<i class="fa fa-edit"></i>
											</a>
											@endcan


											@can('category-delete') 
											<a class="confirmDelete"
											data-action="/dashboard/category/"
											data-id="{{ $category->id }}"
											   href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
											@endcan
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
@endcan
	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	@endpush

@endsection