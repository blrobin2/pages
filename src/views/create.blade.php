@extends('pages::layouts.inner')

@section('page-content')
    <h1>Create a New Page</h1>

    {!! Form::model($page = new \BruceCms\Pages\Page, ['action' => '\BruceCms\Pages\PagesController@store', 'files' => true]) !!}
        @include('pages::form', ['submitButtonText' => 'Create Page'])
    {!! Form::close() !!}
@stop