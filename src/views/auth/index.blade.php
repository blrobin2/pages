@extends('layouts.inner')

@section('header-styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page-content')
    <h1>Admin Manager</h1>
    <p>To create a new admin, <a href="{{ url('admins/create') }}">click here</a>.</p>
    @if(! $users->isEmpty())
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th colspan="2"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr id="{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['\BruceCms\Pages\AuthenticationController
                            Controller@destroy', $user->id], 
                                'class' => '+inline-block']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 
                                'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No admins.</p>
    @endif
@stop