@extends('frontend.layouts.app')

@section('content')
<div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 border p-4">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

              <h3>Login to your Admin Account</h3>
              <hr>
              @if (Session::has('login_error'))
                <div class="alert alert-danger">
                  {{ Session::get('login_error') }}
                </div>
              @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

              <button type="submit" class="btn btn-primary float-left">Login Now</button>
              <div class="float-right">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link text-danger" href="{{ route('admin.password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <div class="clearfix"></div>

            </form>
          </div>
      </div>
    </div>
  </div>

@endsection
