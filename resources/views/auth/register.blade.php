@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100 hero-gradient">
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header py-3 text-center bg-white border-bottom-0">
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <i class="fas fa-bus text-primary fa-lg mr-2"></i>
                        <h4 class="font-weight-bold text-primary mb-0">Travel App</h4>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-0">{{ __('Register') }}</h5>
                </div>

                <div class="card-body p-3 p-md-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0 py-2">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                </div>
                                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="Nama lengkap">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0 py-2">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0 py-2">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password"
                                       placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0 py-2">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control form-control-sm" 
                                       name="password_confirmation" required autocomplete="new-password"
                                       placeholder="Konfirmasi password">
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
                                <i class="fas fa-user-plus mr-2"></i>{{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer text-center py-2 bg-white border-top-0">
                    <p class="small mb-0 text-muted">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-primary font-weight-bold">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection