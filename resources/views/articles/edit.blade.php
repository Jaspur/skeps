@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="large-10 small-12 columns large-centered">
			<h2>Artikel bewerken</h2>
			@include('errors.list')

			{!! Form::model($article, ['method' => 'PATCH', 'url' => 'articles/' . $article->slug]) !!}
				@include('articles._form', ['submitButtonText' => 'Update'])	
			{!! Form::close() !!}
		</div>
	</div>
@endsection