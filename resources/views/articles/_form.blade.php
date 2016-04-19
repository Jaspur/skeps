<div class="small-12 columns">
	<div class="input-group">
		{!! Form::label('title', 'Titel*: ', ['class' => 'input-group-label']) !!}
		{!! Form::text('title', null, ['class' => 'input-group-field']) !!}
	</div>
</div>

<div class="small-12 columns">
	<div class="input-group">
		{!! Form::label('quote', 'Quote: ', ['class' => 'input-group-label']) !!}
		{!! Form::text('quote', null, ['class' => 'input-group-field']) !!}
	</div>
</div>

<div class="small-12 columns">
	{!! Form::label('content', 'Inhoud*: ') !!}
	{!! Form::textarea('content') !!}
</div>

<div class="small-6 columns">
	<div class="input-group">
		{!! Form::label('published_at', 'Publicatie datum: ', ['class' => 'input-group-label']) !!}
		{!! Form::text('published_at', Carbon\Carbon::now(), ['class' => 'input-group-field']) !!}
	</div>
</div>

<div class="small-6 columns">
	<div class="input-group">
		{!! Form::label('main_image', 'Afbeelding toevoegen', ['class' => 'button', 'for' => 'published_at']) !!}
		{!! Form::file('main_image', ['class' => 'hidden']) !!}
	</div>
</div>

<div class="small-12 columns">
	{!! Form::submit($submitButtonText, ['class' => 'button']) !!}
</div>
