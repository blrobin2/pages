@extends('layouts.home')

@section('page-content')
    <h1>{!! $page->title !!}</h1>

    <p>{!! $page->body !!}</p>
@stop