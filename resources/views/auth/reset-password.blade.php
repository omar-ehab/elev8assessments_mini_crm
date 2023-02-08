@extends('layouts.auth.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <a href="{{ route('login') }}" class="app-brand-link gap-2">
                    <span class="app-brand-text demo text-body fw-bolder">CRM DASHBOARD</span>
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Reset Password? 🔒</h4>
            <p class="mb-4">Enter your email and new password </p>
            @if(session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control @error('password') is-invalid @enderror"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        autofocus
                    />
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        required
                    />
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password_confirmation"
                        required
                    />
                </div>
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <button class="btn btn-primary d-grid w-100">Change Password</button>
            </form>
        </div>
    </div>
@endsection
