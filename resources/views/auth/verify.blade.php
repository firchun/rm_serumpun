@extends('layouts.auth_theme.app')

@section('content')
    <!-- [ auth-signin ] start -->
    <div class="auth-wrapper" style="background: #48bdc5;">
        <div class="auth-content">
            <div class="card">
                <div class="card-header"><strong>{{ __('Silahkan Verifikasi Email anda') }}</strong></div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Silahkan cek kembali pada email anda') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                    {{ __('Jika Anda tidak menerima email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-link p-0 m-0 align-baseline">{{ __(' klik di sini untuk meminta kembali verifikasi') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
