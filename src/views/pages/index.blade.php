@extends('layouts.inner')

@section('header-styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page-content')
    <h1 class="page-header">Page Manager</h1>
    <h3>Sorting</h3>
    <p>Drag and Drop rows to sort pages, then click the "Save Sort" button.</p>
    <h3>Parent Pages</h3>
    <p>Select a page from the parent drop down to make that page it's child. You can only set it one level deep.<br> If you
        manage to find a way to set a child as a parent, <strong>the page will disappear</strong> from navigation.<br> To bring
        it back, just set it to a top-level page or to "None".</p>
    <p><a class="btn btn-success" href="{{ url('pages/create') }}">Create a New Page</a></p>
    @if(! $pages->isEmpty())
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Parent</th>
                <th>Hidden?</th>
                <th colspan="2"></th>
            </tr>
            </thead>
            <tbody id="sortable">
            @foreach($pages as $page)
                <tr id="{{ $page->id }}">
                    <td>{{ $page->id }}</td>
                    <td>{!! link_to_action('\BruceCms\Pages\PagesController@show', $page->title, $page->link) !!}</td>
                    <td>
                        <form class="form-inline" method="POST"
                              action="{{ action('\BruceCms\Pages\PagesController@setParent', $page->id) }}">
                            <select name="parent" id="parent" class="form-control">
                                <option name="0" value="0" {{ ($page->id == 0 ? "selected" : "") }}>[None]</option>
                                @foreach($pages as $pageSelection)
                                    @if($pageSelection->id !== $page->id && $pageSelection->parent_id == 0)
                                        <option name="{{$pageSelection->id}}}" value="{{$pageSelection->id}}"
                                                @if($page->parent_id == $pageSelection->id)
                                                selected="selected"
                                                @endif
                                                >{{ $pageSelection->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-info" value="Set Parent">
                        </form>
                    </td>
                    <td>@if($page->hidden) {!! 'Yes' !!} @else {!! 'No' !!} @endif</td>
                    <td>
                        {!! link_to_action('\BruceCms\Pages\PagesController@edit', 'Edit Page', $page->link, ['class' => 'btn btn-default']) !!}
                    </td>
                    <td>

                        {!! Form::open(['method'=>'DELETE','action'=>['\BruceCms\Pages\PagesController@destroy', $page->link], 
                                'class' => '+inline-block']) !!}
                        {!! Form::submit('Delete Page', ['class' => 'btn btn-danger',
                                'onclick' =>'return confirm("Are you sure? This cannot be undone.");']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! Form::open(['action'=>'\BruceCms\Pages\PagesController@sort']) !!}
        <input id="order" name="order" type="hidden" value="1, 2, 3, 4"/>
        <button id="updateSort" class="btn btn-primary">Save Sort</button>
        {!! Form::close() !!}
    @else
        <p>No pages.</p>
    @endif
@stop

@section('footer-scripts')
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
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