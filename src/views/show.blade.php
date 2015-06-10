@extends('pages::layouts.inner')

@section('page-title')
    <h1>{!! $page->title !!}</h1>
@stop

@section('page-content')
    <p>{!! $page->body !!}</p>
@stop