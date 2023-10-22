@extends('layouts.auth_theme.app')

@section('content')
    <!-- [ auth-signin ] start -->
    <div class="auth-wrapper" style="background: #48bdc5;">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card-body">
                                {{-- <img src="{{ asset('frontand_theme/') }}/images/favicon.png" alt=""
                                    class="img-fluid mb-4"> --}}
                                <h1><a href="{{ url('/') }}" class="text-primary">{{ env('APP_NAME') }}</a></h1>
                                <h4 class="mb-3 mt-2 f-w-400">Sign in</h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                    </div>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="lock"></i></span>
                                    </div>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group text-left mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-primary" type="checkbox" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Ingat Login</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-info mb-4">Signin</button>
                                <p class="mb-2 text-muted">Lupa password?
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="f-w-400">Reset</a>
                                    @endif
                                </p>
                                <p class="mb-0 text-muted">Belum Memiliki Akun ? <a href="{{ route('register') }}"
                                        class="f-w-400">Daftar</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ auth-signin ] end -->
@endsection
