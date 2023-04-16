@extends('monitor::layouts.master')

@section('content')
    <h1>Hello World
   {{ __('monitor::en.next') }}
   {{ __('Login') }}
    </h1>

    <p>
        This view is loaded from module: {!! config('monitor.name') !!}
    </p>
@endsection
