@extends('auth.master')

@section('title'){{ __('Login') }}
 {{-- {{ $title }} --}}
@endsection

@push('css')
@endpush

@section('content')
    <section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                        <h4>{{ __('Login') }}</h4>
                        <h6>{{ __('Welcome back! Log in to your account.') }}</h6>
                        <div class="form-group">
                            <label>{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" name="email" required="" placeholder="Test@gmail.com" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required="" placeholder="*********" />
                                <div class="show-hide"><span class="show"> </span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" />
                                <label for="checkbox1">{{ __('Remember password') }}</label>
                            </div>
                            <a class="link" href="('forget-password') ">{{ __('Forgot password?') }}</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">{{ __('Sign in') }}</button>
                        </div>
                        <div class="login-social-title">
                            <h5>{{ __('Sign in with') }}</h5>
                        </div>
                        <div class="form-group">
                            <ul class="login-social">
                                <li>
                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram"> </i></a>
                                </li>
                            </ul>
                        </div>
                        <p>{{ __("Don't have account?") }}<a class="ms-2" href="('sign-up') ">{{ __('Create Account') }}</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

	
    @push('scripts')
    @endpush

@endsection