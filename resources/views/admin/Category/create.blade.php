@extends('layouts.admin.master')

@section('title'){{ __('Create/Edit category')}}
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush

@section('content')
	{{-- @component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Validation Forms</h3>
		@endslot
		<li class="breadcrumb-item">Forms</li>
		<li class="breadcrumb-item">Form Controls</li>
        <li class="breadcrumb-item active">Validation Forms</li>
	@endcomponent
	 --}} @canany([ 'category-create', 'category-edit'])
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>{{ __('Create/Edit category')}}</h5>
					</div>
                    @if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
					<div class="card-body">
						<form class="form-file-action needs-validation" action="{{ isset($category) ? route('categoryUpdate',$category->id) :route('category.store') }}" 
							enctype="multipart/form-data" method="POST" novalidate="">
                            @csrf
							<div class="row g-3">
								<div class="col-md-4">
									<label class="form-label" for="fullName">{{ __('Full name')}}</label>
									<input class="form-control textValid" value="{{ isset($category->name) ? $category->name :'' }}" 
									{{-- onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" --}}
									 id="fullName" type="text" name="name" required="" />
                                    <div class="invalid-feedback">{{ __('Please provide a valid Full name.')}}</div>
								</div>
                                <div class="col-md-4 pt-4">
							<button class="btn btn-primary" type="submit">{{ __('Submit form')}}</button>

                                </div>
							</div>
						</form>
					</div>
				</div>
            </div>
		</div>
	</div>
	
	@endcan
	@push('scripts')
	<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
  
	<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>

	@endpush

@endsection