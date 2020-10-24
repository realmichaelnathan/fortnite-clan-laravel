@extends('layouts.blank')

@section('title', 'Sign in to your account')

@section('content')
<div id="loginbox-container" class="container-fluid d-flex justify-content-center align-items-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mt-1">
                            {{ $error }}
                        </div>
                @endforeach
            @endif
            <div id="loginbox" class="card p-3 p-md-2 p-lg-4">
                <div class="card-body d-flex justify-content-center pb-0" style="padding-top: 20px;">
                    <a href="/">
                        <img src="{{asset('images/fortniteclanlogo.png')}}" alt="Fortnite Clan" style="height:40px; width: auto;">
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col">
                                <div class="form-label-group mb-0">
                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                                    <label for="email">Email</label>
                                </div>
                                
                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <div class="form-label-group mb-0">
                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required autocomplete="current-password">
                                    <label for="password">Password</label>
                                </div>
                              
                                @if($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-block text-white mt-2" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <a class="btn btn-link btn-block text-white m-0" href="/register">
                                    Create Account
                                </a>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="form-group row mt-3 mb-0">
                        <div class="col">
                            <a href ="/login/twitter" class="btn btn-block twitter">
                                <i class="fab fa-twitter"></i> Login  With Twitter
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

</div>

@endsection
