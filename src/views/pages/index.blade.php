@extends('layouts.inner')

@section('header-styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
@stop

@section('page-content')
    <h1>Page Manager</h1>
    <h2>(Drag and drop rows to sort pages):</h2>
    <p>To create a new page, <a href="{{ url('pages/create') }}">click here</a>.</p>
    @if(! $pages->isEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Hidden?</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($pages as $page)
                <tr id="{{ $page->id }}">
                    <td>{{ $page->id }}</td>
                    <td>{!! link_to_action('\BruceCms\Pages\PagesController@show', $page->title, $page->link) !!}</td>
                    <td>@if($page->hidden) {!! 'Yes' !!} @else {!! 'No' !!} @endif</td>
                    <td>
                        {!! link_to_action('\BruceCms\Pages\PagesController@edit', 'Edit', $page->link, ['class' => 'btn btn-default']) !!}
                        {!! Form::open(['method'=>'DELETE','action'=>['\BruceCms\Pages\PagesController@destroy', $page->link], 'class' => '+inline-block']) !!}
                              {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! Form::open(['action'=>'\BruceCms\Pages\PagesController@sort']) !!}
            <input id="order" name="order" type="hidden" value="1, 2, 3, 4" />
            <button id="updateSort" class="btn btn-primary">Sort Pages</button>
        {!! Form::close() !!}
    @else
        <p>No pages.</p>
    @endif
@stop

@section('footer-scripts')
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $('#sortable').sortable({
                cursor: 'move',
                axis: 'y',
                update: function (event, ui) {
                    var order = $(this).sortable('toArray');
                    $('#order').val(order);
                }
            });
            $('#sortable').disableSelection();
        });
    </script>
@stop