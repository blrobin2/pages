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
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
@stop