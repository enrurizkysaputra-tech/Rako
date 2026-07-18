@extends('layouts.app')
@section('title', 'Edit Profil')
@section('content')

    <h3 class="mb-4">Edit Profil</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

@endsection