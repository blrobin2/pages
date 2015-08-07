@extends('layouts.inner')

@section('content')
    <h1 class="page-header">Edit Profile</h1>
    <p>Use the form below to update your settings. To reset your password, please use <a href="{{ action('Auth\PasswordController@getEmail') }}">the forgot password form.</a></p>

    <form class="form" method="post" action="{{ action('BruceCms\Pages\AuthenticationController@postProfile', $user->id) }}"
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>

        <input type="submit" class="btn btn-lg btn-primary" value="Save">
    </form>
@stop