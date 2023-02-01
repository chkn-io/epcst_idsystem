@extends('layouts.login')
@section('content')
    <form hidden method="POST" id="login-form" action="{{ route('login') }}">
        @csrf
        <div class="col-12 mb-2">
            <label for="yourUsername" class="form-label">{{ __('Username') }}</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">
                    <i class="fas fa-user"></i>
                </span>
                <div class="invalid-feedback">Please enter your username.</div>

                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2">
            <label for="yourPassword" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-12 mb-2">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success w-100">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </form>

    <div id="scanning-anim">
        <img width="100%" src="{{ asset('img/rfid-scanning.gif') }}" alt="">
        <form method="POST" action="{{ route('guard') }}">
            @csrf
            <input style="opacity:0;position:absolute;left:-9999px" type="text" name="rfid" required id="rfid">
        </form>
       
        @if($errors->any())
          <div class="alert alert-danger text-center">
            <strong>Danger!</strong> {{$errors->first()}}
          </div>
        @endif
    </div>
@endsection
