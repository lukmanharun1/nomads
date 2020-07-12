@extends('layouts.app')

@section('content')
<main class="login-container">
    <div class="container">
      <div class="row page-login d-flex align-items-center">
        <div class="section-left col-12 col-md-6">
        
          <img src="{{ url('frontend/image/send_email.png') }}" alt="" class="w-75 d-none d-sm-flex">
        </div>
        <div class="section-right col-12 col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="text-center">
                <img src="{{ url('frontend/image/logo.png') }}" alt="" class="w-50 mb-4">
              </div>
              <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

              <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                  <label for="email">{{ __('E-Mail Address') }}</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login btn-block">{{ __('Send Password Reset Link') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

