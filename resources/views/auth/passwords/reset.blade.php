@extends('layouts.blank')

@section('content')

<div id="loginbox-container" class="container-fluid d-flex justify-content-center align-items-center">
    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
            <div id="loginbox" class="card">
                <div class="card-body d-flex justify-content-center pb-0">
                    <a href="/">
                        <img src="{{ asset('images/fortniteclanlogo.png') }}" alt="Fortnite Clan"
                            style="height:40px; width: auto;">
                    </a>
                </div>
                <div class="card-body d-flex justify-content-center pb-0">
                    <h2>{{ __('Reset Password') }}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <div class="col">
                                <div class="form-label-group mb-0">
                                    <input id="email" type="email"
                                        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" required
                                        autocomplete="email" placeholder="Email" autofocus>
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
                                <div class="form-label-group mb-0">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
