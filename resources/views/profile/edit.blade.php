@extends('layouts.admin')

@section('content')
<div class="admin-page admin-page--form">
    <div class="admin-page-header">
        <h1>My Profile</h1>
    </div>

    {{-- Profile info --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Profile Information</h2>
            <p>Update your name and email address.</p>
        </div>
        <form method="post" action="{{ route('profile.update') }}" class="profile-form">
            @csrf
            @method('patch')

            <div class="profile-field">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autocomplete="name">
                @error('name')<span class="profile-error">{{ $message }}</span>@enderror
            </div>

            <div class="profile-field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')<span class="profile-error">{{ $message }}</span>@enderror
            </div>

            <div class="profile-actions">
                <button type="submit" class="btn-primary profile-save-btn">Save changes</button>
                @if(session('status') === 'profile-updated')
                    <span class="profile-saved">Saved ✓</span>
                @endif
            </div>
        </form>
    </div>

    {{-- Password --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Change Password</h2>
            <p>Use a strong, random password to keep your account secure.</p>
        </div>
        <form method="post" action="{{ route('password.update') }}" class="profile-form">
            @csrf
            @method('put')

            <div class="profile-field">
                <label for="current_password">Current password</label>
                <input id="current_password" name="current_password" type="password" autocomplete="current-password">
                @error('current_password', 'updatePassword')<span class="profile-error">{{ $message }}</span>@enderror
            </div>

            <div class="profile-field">
                <label for="new_password">New password</label>
                <input id="new_password" name="password" type="password" autocomplete="new-password">
                @error('password', 'updatePassword')<span class="profile-error">{{ $message }}</span>@enderror
            </div>

            <div class="profile-field">
                <label for="password_confirmation">Confirm new password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')<span class="profile-error">{{ $message }}</span>@enderror
            </div>

            <div class="profile-actions">
                <button type="submit" class="btn-primary profile-save-btn">Update password</button>
                @if(session('status') === 'password-updated')
                    <span class="profile-saved">Password updated ✓</span>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
