@extends('layouts.admin.master')

@section('title'){{ __('Create/Edit application')}}
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">


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
	 --}}
	 @canany([ 'app-create', 'app-edit'])
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>{{ __('Create/Edit application')}}</h5>
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
						<form class="form-file-action needs-validation" action="{{ isset($application) ? route('appUpdate',$application->id) :route('app.store') }}" 
							enctype="multipart/form-data" method="POST" novalidate="">
                            @csrf
							<div class="row g-3">
								<div class="col-md-4">
									<label class="form-label" for="fullName">{{ __('application name')}}</label>
									<input class="form-control textValid" value="{{ isset($application->name) ? $application->name :'' }}" 
									{{-- onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" --}}
									 id="fullName" type="text" name="name" required="" />
                                    <div class="invalid-feedback">{{ __('Please provide a valid Full name.')}}</div>
								</div>

								<div class="col-md-4 mb-3">
									<label class="form-label" for="domain">{{ __('domain')}}</label>
									<div class="input-group">
										<span class="input-group-text" id="inputGroupPrepend">@</span>
										<input class="form-control" id="domain" type="text"
										value="{{ isset($application->domain) ? $application->domain :'' }}" 
										 name="domain" placeholder="domain" aria-describedby="inputGroupPrepend" required="" />
										<div class="invalid-feedback">{{ __('Please provide a valid domain.')}}</div>
									</div>
								</div>
                                <div class="col-md-4 date-picker">
									<label class="form-label" for="ip">{{ __('ip')}}</label>
                                      <input class="input-group-text"
									  value="{{ isset($application->ip) ? $application->ip :'' }}"  id="ip"
									  name="ip" type="text" data-language="en" />
									<div class="valid-feedback">{{ __('Please select a ip.')}}</div>
								</div>
							</div>
							<div class="row g-3">
								<div class="col-md-3">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="status">{{ __('status')}}</label>
                                      </div>
                                      <div class="col">
                                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                          <div class="radio radio-primary">
                                            <input id="male" type="radio"  name="status" value="1" {{isset($application->status)? $application->status == 1 ? 'checked' :'':'' }}>
                                            <label class="mb-0" for="male">{{ __('Active')}}</label>
                                          </div>
                                          <div class="radio radio-primary">
                                            <input id="female" type="radio" name="status" value="0" {{ isset($application->status)? $application->status == 0 ? 'checked' :'':'' }}>
                                            <label class="mb-0" for="female">{{ __('unActive')}}</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="invalid-feedback">{{ __('Please select a status.')}}</div>
								</div>
								<div class="col-md-3">
									<label class="form-label" for="category">{{ __('Category')}}</label>
							
									<select class="form-select" name="category" id="category" required="">
										<option selected="" disabled="" value="">{{ __('Choose...')}}</option>
								
								
										@foreach ($Category as $Cat)
										<option value="{{ $Cat->id }}"
                                         {{   isset($application->category)? $application->category == $Cat->id ? 'selected' :'':''}}
                                          >{{ $Cat->name }}</option>
										@endforeach
									
									
										
									</select>
									<div class="invalid-feedback">{{ __('Please select a valid Category.')}}</div>
								</div>
								@can('app-add-user') 
								<div class="col-md-6 ">
									<label class="form-label">{{ __('select Users')}}</label>
									<select class="js-example-basic-multiple col-sm-12" name="user[]" multiple="multiple">
									
										@if(isset($userApp) && $userApp!=null)
										@foreach ($userApp as $KuserApp => $userApp)
										@foreach ($users as $Kuser => $user)
										<option value="{{ $Kuser }}"@if($Kuser == $KuserApp)selected="selected"@endif>{{ $user }}</option>
										@endforeach
										@endforeach
										@else
								
										@foreach ($users as $users)
										<option value="{{ $users }}">{{ $users }}</option>
										@endforeach
									
										@endif

									</select>
								</div>
							@endcan

							</div>
                           
                            <div class="row g-3">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" >{{ __('Upload Image')}}</label>
                                    <input class="form-control custom-upload__input" name="image" type="file" id="file" 
										value="{{ isset($application->img) ? $application->img :'' }}" 
                                            accept="image/*" onchange="readURL(this);">

                                    <img id="blah" style="width: 35%;"
									 src="  {{ asset('img') }}/{{ isset($application->img) ? $application->img : '' }}" style="">
								</div>

                                <div class="col-md-9 mb-3">
                                    
                                  
									<label class="form-label" for="note">{{ __('note')}}</label>
									<textarea class="form-control"name="note" id="note" >{{ isset($application->note) ? $application->note :'' }}</textarea>
                                   
                                    <div class="invalid-feedback">{{ __('Please provide a valid note')}}</div>
								</div>
                                  
									</div>
							
							<button class="btn btn-primary" type="submit">{{ __('Submit form')}}</button>
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
	<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
	@endpush

@endsection