@extends('layouts.admin.master')

@section('title'){{ __('activity')}}
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
                    <h5>{{ __('activity user')}} </h5>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>{{ __('log_name')}}</th>
                                    <th>{{ __('description ')}}</th>
                                    <th>{{ __('subject_type')}}</th>
                                    <th>{{ __('causer')}}</th>
                                    <th>{{ __('properties')}}</th>
                                    <th>{{ __('event')}}</th>
                                    <th>{{ __('Created')}}</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($activities as $activity)
                                <tr>

                                    <td>{{  $activity->log_name }}</td>
                                    <td>{{  $activity->description  }}</td>
                                    <td>{{  $activity->subject_type }}</td>
                                    <td>{{  $activity->causer->name }}</td>
                                    @if ($activity->description == 'updated')

                                    <td>
                                    @foreach ($activity->properties['attributes'] as $key => $value)
                                        @if ($value != $activity->properties['old'][$key])
                                        <div>New {{ $key }}: {{ $value}}</div>
                                        <div>Original {{ $key }}: {{$activity->properties['old'][$key]}}
                                            @endif
                                     @endforeach
                                    </td>
                                    @else
                                    <td></td>

                                    @endif
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
