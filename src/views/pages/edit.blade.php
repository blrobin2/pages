@extends('layouts.inner')

@section('page-content')
    <h1>Edit Page:</h1>

    {!! Form::model($page, ['method' => 'PATCH', 'route' => ['updatePage', $page->link]]) !!}
        @include('pages.form', ['submitButtonText' => 'Update Page'])
    {!! Form::close() !!}
@stop