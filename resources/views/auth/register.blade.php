@extends('layouts.blank')

@section('title', 'Sign up for a new account!')

@section('content')

<div id="loginbox-container" class="container-fluid d-flex justify-content-center align-items-center">
    <div class="col-12 col-sm-8 col-md-6 col-lg-8">
            <div class="alert alert-info mt-3 mt-lg-0" role="alert">
                <h4 class="alert-heading text-center">🔔 Email Verification Required 💌</h4>
                <p>Users will be required to verify their email address before being able to take advantage of 
                    all the benefits included in membership.💕
                </p>
            </div>
            @if ($errors->any())
                      @foreach ($errors->all() as $error)
                              <div class="alert alert-danger mt-1">
                                  {{ $error }}
                              </div>
                      @endforeach
               @endif
               <div id="loginbox" class="card p-3">
                <div class="card-body d-flex justify-content-center pb-0" style="padding-top: 20px;">
                    <a href="/">
                        <img src="{{asset('images/fortniteclanlogo.png')}}" alt="Fortnite Clan" style="height:40px; width: auto;">
                    </a>
                </div>
                <div class="card-body mt-2">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">                                
                            <div class="col-12 col-lg-6">
                                <div class="form-label-group">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                <label for="name">Username</label>
                           </div>
                                @if ($errors->has('gameusername'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gameusername') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                            <div class="col-12 col-lg-6">
                                 <div class="form-label-group">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                 </div>
                          
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
           
                            <div class="col-12 col-lg-6">
                                 <div class="form-label-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <label for="password" >{{ __('Password') }}</label>
                                 </div>
                           
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12 col-lg-6">
                                 <div class="form-label-group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>

                        </div>
                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                            <div class="row justify-content-center mb-2 g-recaptcha"
                                data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                            </div>
                        @endif
                        <div class="form-group row justify-content-center mb-0">

                            <button type="submit" class="btn btn-primary btn-block mt-3">
                                {{ __('Register') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
