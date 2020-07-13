@extends('layouts.app')
@section('title', 'Registrasi NOMADS')
@section('content')
<main class="login-container">
    <div class="container">
      <div class="row page-login d-flex align-items-center">
        <div class="section-left col-12 col-md-6">
          <h1 class="mb-4">explore the new <br> life much better</h1>
          <img src="{{ url('frontend/image/login-images.png') }}" alt="" class="w-75 d-none d-sm-flex">
        </div>
        <div class="section-right col-12 col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="text-center">
                <img src="{{ url('frontend/image/logo.png') }}" alt="" class="w-50 mb-4">
              </div>
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="username">{{ __('Username') }}</label>
                    <input type="username" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>

                <div class="form-group">
                  <label for="email">{{ __('E-Mail Address') }}</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
  
                <div class="form-group">
                  <label for="password">{{ __('Password') }}</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" id="password" name="password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control" required autocomplete="current-password" id="password-confirm" name="password_confirmation">
                  </div>
                <button type="submit" class="btn btn-login btn-block">{{ __('Register') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
