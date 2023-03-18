@extends('layouts.admin.master')

@section('title')Validation Forms
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
	 --}}
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Create/Edit user</h5>
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
						<form class="needs-validation" action="{{ isset($user) ? route('updateUser',$user->id) :route('saveUser') }}" method="POST" novalidate="">
                            @csrf
							<div class="row g-3">
								<div class="col-md-4">
									<label class="form-label" for="fullName">Full name</label>
									<input class="form-control" value="{{ isset($user->name) ? $user->name :'' }}" 
									 id="fullName" type="text" name="name" required="" />
                                    <div class="invalid-feedback">Please provide a valid Full name.</div>
								</div>

								<div class="col-md-4 mb-3">
									<label class="form-label" for="Email">Email</label>
									<div class="input-group">
										<span class="input-group-text" id="inputGroupPrepend">@</span>
										<input class="form-control" id="Email" type="text"
										value="{{ isset($user->email) ? $user->email :'' }}" 
										 name="email" placeholder="email" aria-describedby="inputGroupPrepend" required="" />
										<div class="invalid-feedback">Please provide a valid Email.</div>
									</div>
								</div>
                                <div class="col-md-4 date-picker">
									<label class="form-label" for="birthday">birthday</label>
                                      <input class="datepicker-here form-control digits"
									  value="{{ isset($user->birthday) ? $user->birthday :'' }}"  id="birthday"
									  name="birthday"
                                       type="text" data-language="en" />
									<div class="valid-feedback">Please select a birthday.</div>
								</div>
							</div>
							<div class="row g-3">
								<div class="col-md-3">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="gender">gender</label>
                                      </div>
                                      <div class="col">
                                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                          <div class="radio radio-primary">
                                            <input id="male" type="radio"  name="gender" value="1" {{isset($user->gender)? $user->gender == 1 ? 'checked' :'':'' }}>
                                            <label class="mb-0" for="male">male</label>
                                          </div>
                                          <div class="radio radio-primary">
                                            <input id="female" type="radio" name="gender" value="0" {{ isset($user->gender)? $user->gender == 0 ? 'checked' :'':'' }}>
                                            <label class="mb-0" for="female">female</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="invalid-feedback">Please select a gender.</div>
								</div>
								<div class="col-md-3">
									<label class="form-label" for="role">role</label>
							
									<select class="form-select" name="role" id="role" required="">
										<option selected="" disabled="" value="">Choose...</option>
										@if(isset($userRole) && $userRole!=null)
										@foreach ($userRole as $userRole)
										@foreach ($roles as $roles)
										<option value="{{ $roles }}"@if($roles == $userRole)selected="selected"@endif>{{ $roles }}</option>
										@endforeach
										@endforeach
										@else
								
										@foreach ($roles as $roles)
										<option value="{{ $roles }}">{{ $roles }}</option>
										@endforeach
									
										@endif
										
									</select>
									<div class="invalid-feedback">Please select a valid role.</div>
								</div>
								<div class="col-md-3 mb-3">
                                    <label class="form-label" for="address">address</label>
									<input class="form-control" id="address"
									value="{{ isset($user->address) ? $user->address :'' }}"  type="text" name="address" placeholder="City" required="" />
									<div class="invalid-feedback">Please provide a valid city.</div>
								</div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="phone_number">phone_number</label>
                                    <input class="form-control m-input digits"
									value="{{ isset($user->phone_number) ? $user->phone_number :'' }}"  name="phone_number" id="phone_number"
                                     type="tel" placeholder="91-(999)-999-999">					
                            	<div class="invalid-feedback">Please provide a valid phone_number.</div>
								</div>

							</div>
                           
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" >Upload Image</label>
                                    <input class="form-control" name="img" type="file" >								
                            
								</div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="exampleInputPassword2">Password</label>
                                    <input required="" class="form-control" id="exampleInputPassword2" name="password" type="password" placeholder="Password" />
                                    <div class="invalid-feedback">Please provide a valid password</div>
								</div>
                                  
									</div>
                              
							<div class="mb-3">
								<div class="form-check">
									<div class="checkbox p-0">
										<input class="form-check-input" id="invalidCheck" type="checkbox" required="" />
										<label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
									</div>
									<div class="invalid-feedback">You must agree before submitting.</div>
								</div>
							</div>
							<button class="btn btn-primary" type="submit">Submit form</button>
						</form>
					</div>
				</div>
            </div>
		</div>
	</div>
	
	
	@push('scripts')
	<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
  
	<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
	@endpush

@endsection