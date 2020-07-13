@extends('layouts.app')

@section('content')
  <div class="container row justify-content-center ml-5">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <img src="{{ url('frontend/image/logo.png') }}" alt="" class="w-50 mb-4">
        </div>
        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="password">{{ __('New Password') }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" id="password" name="password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>
          <button type="submit" style="background-color: #ff9e53;" class="btn btn-login btn-block"> {{ __('Reset Password') }}</button>
        </form>
      </div>
    </div>
  </div>
@endsection
