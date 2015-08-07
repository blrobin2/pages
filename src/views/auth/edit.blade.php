@extends('layouts.inner')

@section('content')
    <h1 class="page-header"><a href="{{ URL::previous() }}">&larr; Back</a> | Edit Profile</h1>
    <p>Use the form below to update your settings.</p>

    <form class="form" method="post" action="{{ action('\BruceCms\Pages\AuthenticationController@update', $user->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <p class="help-block">Leave blank if you are not changing it.</p>
        </div>

        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            <p class="help-block">Leave blank if you are not changing it.</p>
        </div>

        <input type="submit" class="btn btn-lg btn-primary" value="Save">
    </form>
@stop