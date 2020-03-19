@extends('layout')

@section('title', 'Sign up for a new account!')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading text-center">🔔 Email Verification Required 💌</h4>
                <p>Due to a high volume of fake accounts being created, users will be required to verify their email address before being able to take advantage of 
                    all the benefits included in membership. This includes voting for your favorite clan. 💕
                </p>
            </div>
            <div class="">
                <div class="card-body mt-2">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">                                
                            <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                           </div>
                                @if ($errors->has('gameusername'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gameusername') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                 <div class="input-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                </div>
                           </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                 <div class="input-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                           </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                 <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                           </div>
                            </div>
                        </div>
                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                            <div class="row justify-content-center mb-2 g-recaptcha"
                                data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                            </div>
                        @endif
                        <div class="form-group row justify-content-center mb-0">

                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4 justify-content-center">
          <div class="col">
               <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
               <!-- fnclan-horizontal -->
               <ins class="adsbygoogle"
                    style="display:flex; justify-content:center"
                    data-ad-client="ca-pub-9720848360917466"
                    data-ad-slot="1251108935"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
               <script>

                    (adsbygoogle = window.adsbygoogle || []).push({});

               </script>
          </div>
     </div>
</div>

@endsection
