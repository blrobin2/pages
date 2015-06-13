<!-- Title Form Input -->
<div class="form-group">
	{!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<!-- Link Form Input -->
<div class="form-group">
	{!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control', 'required' => 'required']) !!}
    <p class="help-block">No spaces. For multiple words, use dashes('-')</p>
</div>

<!-- Body Form Input -->
<div class="form-group">
	{!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Hidden Form Input -->
<div class="form-group">
	{!! Form::label('hidden', 'Hidden from Navigation?:') !!}
    {!! Form::checkbox('hidden', 1, false, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>

@section ('footer-scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                 "table code contextmenu directionality emoticons paste textcolor responsivefilemanager"
           ],
           toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
           toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
           image_advtab: true ,
           relative_urls: false,
           external_filemanager_path:"/filemanager/",
           filemanager_title:"Responsive Filemanager" ,
           external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
        });
@stop